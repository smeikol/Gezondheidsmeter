<?php
$url = $_SERVER['REQUEST_URI'];
$parts = parse_url($url);
$path_parts = explode('/', $parts['path']);
if ($path_parts[count($path_parts) - 3] == "Admin") {
    $checker = true;
} else {
    $checker = false;
}
?>


<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom" style="background-color: 	#089000;">
    <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="<?php if ($checker) { echo ('../../../Pages/Home/'); } else { echo ('../../Pages/Home/'); } ?>" class="nav-link px-2" style="color: white;">Home</a></li>
        <li><a href="<?php if ($checker) { echo ('../../../Pages/Dashboard/'); } else { echo ('../../Pages/Dashboard/'); } ?>" class="nav-link px-2" style="color: white;">Dashboard</a></li>
    </ul>


    <div class="col-md-3 text-end">
        <a href="../../Pages/Login/" class="btn btn-outline-light me-2">Login</a>
        <a href="../../Pages/Signup/" class="btn btn-outline-light me-2">Sign-up</a>
    </div>

</header>