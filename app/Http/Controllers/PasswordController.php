<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     *
     * @return View
     */
    public function showLinkRequestForm(): View
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a password reset link to the given user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        // 1、验证邮箱
        $request->validate(['email' => 'required|email']);
        $email = $request->input('email');

        // 2、获取对应的用户
        $user = User::where('email', $email)->first();

        // 3、如果用户不存在，返回错误信息
        if (is_null($user)) {
            return redirect()->back()->withInput()->with('danger', 'This email address is not registered.');
        }

        // 4、如果用户存在，生成重置密码的token, 会在 emails.reset_link 里面拼接链接
        $token = hash_hmac('sha256', Str::random(40), config('app.key'));

        // 5、将 token、email 存入数据库, 使用 updateOrInsert 方法来保持 email 唯一
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => new Carbon,
            ]
        );

        // 6、发送邮件
        Mail::send('emails.reset_link', ['token' => $token], function ($message) use ($email) {
            $message->to($email)->subject('Reset Password');
        });

        // 7、返回成功信息
        return redirect()->back()->with('success', 'We have emailed your password reset link!');
    }

    /**
     * Display the form to reset the password.
     *
     * @param Request $request
     * @return View
     */
    public function showResetForm(Request $request): View
    {
        $token = $request->route()->parameter('token');
        return view('auth.passwords.reset', ['token' => $token]);
    }

    /**
     * Reset the password for the given user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function reset(Request $request): RedirectResponse
    {
        // 1、验证数据
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required',
        ]);
        $email = $request->input('email');
        $token = $request->input('token');
        $expires = 60 * 10; // 找回密码链接的有效时间, 10分钟过期

        // 2、获取对应的用户
        $user = User::where('email', $email)->first();

        // 3、如果用户不存在，返回错误信息
        if (is_null($user)) {
            return redirect()->back()->withInput()->with('danger', 'This email address is not registered.');
        }

        // 4、获取 password_reset_tokens 表中的重置密码的记录
        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        // 5、如果没有记录，返回错误信息
        if (!$record) {
            return redirect()->back()->withInput()->with('danger', 'This password reset token is invalid.');
        }

        // 6、如果 token 不匹配，返回错误信息
        if (!Hash::check($token, $record->token)) {
            return redirect()->back()->withInput()->with('danger', 'This password reset token is invalid.');
        }

        // 7、如果 token 已过期，返回错误信息
        // Carbon::parse($record->created_at])->addSeconds($expires)->isPast()
        if (Carbon::now()->diffInSeconds() > $expires) {
            return redirect()->back()->withInput()->with('danger', 'This password reset token has expired.');
        }

        // 8、一切正常，更新用户密码
        $user->update(['password' => bcrypt($request->input('password'))]);
        return redirect()->route('login')->with('success', 'Your password has been reset!');
    }
}
