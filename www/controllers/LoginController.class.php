<?php
require_once(dirname(__FILE__) . '/../class/View.class.php');
require_once(dirname(__FILE__) . '/../class/SessionController.class.php');
require_once(dirname(__FILE__) . '/../class/User.class.php');
class LoginController
{
    public static function showLogin()
    {
        // This shows the login page
        $sessionController = SessionController::getInstance();
        $sessionController->makeSureLoggedOut('/'); // Why a logged in user want to access this page?

        $loginPageView = new View('login', 'Login');
        $loginPageView->render();
    }

    public static function processLogin()
    {
        // This shows the submitted login page
        $sessionController = SessionController::getInstance();
        $sessionController->makeSureLoggedOut('/'); // Why a logged in user want to access this page?

        $loginPageView = new View('login', 'Login');

        $user = User::getUserByUsernameAndPassword(
            htmlspecialchars($_POST["username"]), htmlspecialchars($_POST["password"]));
        if ($user != null) { // Is a user with this username and hashed password pair already exists?
            // If yes, logs the user in
            SessionController::getInstance()->login($user);
            header("Location: /");
            exit(); // No futher execution is needed
        } else {
            $loginPageView->addVar('error', 'Invalid username or password');
        }
        $loginPageView->render();
    }

    public static function logout()
    {
        // This shows the logout page
        $sessionController = SessionController::getInstance();
        $sessionController->makeSureLoggedIn('/login'); // Why a logged out user want to access this page?

        // Logout user
        SessionController::getInstance()->logout();

        $logoutView = new View('logout', 'Logout');
        $logoutView->render();
    }

    public static function showRegister()
    {
        // This shows the register page
        $sessionController = SessionController::getInstance();
        $sessionController->makeSureLoggedOut('/'); // Why a logged in user want to access this page?

        $registerPageView = new View('register', 'Register');
        $registerPageView->render();
    }

    public static function processRegister()
    {
        // This shows the submitted register page
        $sessionController = SessionController::getInstance();
        $sessionController->makeSureLoggedOut('/'); // Why a logged in user want to access this page?

        $registerPageView = new View('register', 'Register');
        if (User::getUserByUsername(htmlspecialchars($_POST["username"])) == null) { // Is a user with this username already exists?
            // If no, insert a new record
            $user = new User();
            $user->username = htmlspecialchars($_POST["username"]);
            $user->password = htmlspecialchars($_POST["password"]);
            $user->email = htmlspecialchars($_POST["email"]);
            if (User::createNewUser($user)) {
                // Register succeed
                $registerPageView = new View('notice', 'Register Succeed');
                $registerPageView->addVar('title', 'Registering: Succeed');
                $registerPageView->addVar('content', 'You have successfully registered.');
                $registerPageView->addVar('link', '/login');
                $registerPageView->addVar('linkText', 'Go to the login page');
                $registerPageView->render();
                exit(); // Rest of the code should not be executed.
            } else {
                // Failed to create new user

            }
        }

        $registerPageView->addVar('error', 'Failed to create new user');
        $registerPageView->render();
    }

    public static function showUpload()
    {
        // This shows the upload page
        $sessionController = SessionController::getInstance();
        $sessionController->makeSureLoggedIn('/login'); // Why a logged out user want to access this page?

        $uploadPageView = new View('upload', 'Upload');
        $uploadPageView->addVar('csrf', SessionController::getInstance()->getCsrf());
        $uploadPageView->render();
    }

    public static function processUpload()
    {
        // This shows the submitted upload page
        $sessionController = SessionController::getInstance();
        $sessionController->makeSureLoggedIn('/login'); // Why a logged out user want to access this page?

        if ($_POST['csrf'] != $sessionController->getCsrf()) {
            ServerError::throwError(403, "Invalid CSRF token");
        }

        //check if is image
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["profile_image"]["tmp_name"]);
        finfo_close($finfo);
        if (strpos($mime, 'image') === false) {
            $uploadPageView = new View('upload', 'Upload');
            $uploadPageView->addVar('error', 'Please select an image file.');
            $uploadPageView->render();
            return;
        }

        $target_file = "img/" . $sessionController->getUser()->username . ".jpg";
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $uploadOKView = new View('notice', 'Upload Succeed');
            $uploadOKView->addVar('title', 'Upload: Succeed');
            $uploadOKView->addVar('content', 'You have successfully uploaded your file.');
            $uploadOKView->addVar('link', '/');
            $uploadOKView->addVar('linkText', 'Back to the main page');
            $uploadOKView->render();
        } else {
            $uploadPageView = new View('upload', 'Upload');
            $uploadPageView->addVar('error', 'Sorry, there was an error uploading your file.');
            $uploadPageView->render();
        }
    }
}
