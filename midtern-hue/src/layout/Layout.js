import {
  Link,
  Outlet,
} from "react-router-dom";
function Layout() {
  return (
    <div>
      <nav className="navbar navbar-expand-lg bg-light">


        <ul className="navbar-nav me-auto mb-2 mb-lg-0">
          <li className="nav-item">
            <Link className="nav-link active" aria-current="page" to="/">Home</Link>
          </li>
          <li className="nav-item">
            <Link className="nav-link" to="/create">Create</Link>
          </li>
          <li className="nav-item">
            <Link className="nav-link" to="/count">Thong ke</Link>
          </li>


        </ul>

      </nav>
      <div className="content">
        <Outlet />
      </div>
    </div>
  );
}
export default Layout;