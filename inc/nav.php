<header aria-label="Site Header" class="shadow">
    <div class="container max-w-screen-lg mx-auto overflow-hidden">
        <div class=" flex h-16 max-w-screen-xl items-center justify-between px-4">
            <div class="flex w-0 flex-1 gap-4 md:gap-20 items-center">

                <?php if(isset($_SESSION["auth"])): ?>
                <a class="inline-block overflow-hidden" href="index.php">
                    <img class="w-[50%]" src="images/hamada.png" alt="LOGO">
                </a>
                <a class="relative font-medium text-indigo-600 before:absolute before:-bottom-1 before:h-0.5 before:w-full before:origin-left before:scale-x-0 before:bg-indigo-600 before:transition hover:before:scale-100"
                    href="profile.php">
                    Profile
                </a>
                <?php else: ?>
                <a class="relative font-medium text-indigo-600 before:absolute before:-bottom-1 before:h-0.5 before:w-full before:origin-left before:scale-x-0 before:bg-indigo-600 before:transition hover:before:scale-100"
                    href="login.php">
                    Log in
                </a>

                <a class="relative font-medium text-indigo-600 before:absolute before:-bottom-1 before:h-0.5 before:w-full before:origin-left before:scale-x-0 before:bg-indigo-600 before:transition hover:before:scale-100"
                    href="register.php">
                    Sign up
                </a>
                <?php endif; ?>
            </div>

            <div class="flex items-center ">
                <?php if(isset($_SESSION["auth"])): ?>

                <a class="inline-block rounded border border-red-600 px-3 py-1 text-sm font-medium text-red-600 hover:bg-red-600 hover:text-white focus:outline-none focus:ring active:bg-red-500"
                    href="logout.php">
                    Log out
                </a>
                <?php else: ?>
                <a class="inline-block overflow-hidden" href="index.php">
                    <img class="w-[50%]" src="images/hamada.png" alt="LOGO">
                </a>
                <?php endif; ?>
            </div>
        </div>

    </div>
    </div>
</header>