// 导入 Bootstrap 到 CSS
import 'bootstrap/dist/css/bootstrap.min.css';

// 2. 导入包含 Tailwind 指令的 CSS 文件
//    Vite 会自动通过 PostCSS 处理这个文件中的 @tailwind 指令
import '../css/app.css';

// 3. 导入自己的 SASS/SCSS 文件
// 这些样式将最后应用，可以用来覆盖 Bootstrap 或 Tailwind 的样式
import '../sass/app.scss';

// 4. 导入你的 JavaScript (通常包括 Bootstrap JS 的初始化)
// 这个文件通常在 resources/js/bootstrap.js，用于初始化 Bootstrap JS 和 Axios 等
import './bootstrap';
