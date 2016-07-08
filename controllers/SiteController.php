<?php

//include_once ROOT. '/models/Category.php';
//include_once ROOT. '/models/Product.php';


class SiteController
{

    public function actionIndex()
    {
        $categories = Category::getCategoriesList();

        $latestProducts = Product::getLatestProducts(6);

        $sliderProducts = Product::getRecommendedProducts();
        
        require_once(ROOT . '/views/site/index.php');

        return true;
    }

    public function actionContact() {
        $userEmail = '';
        $userText = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }

            if ($errors == false) {
                $adminEmail = 'lex_3000@mail.ru';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }
        require_once (ROOT . '/views/site/contact.php');

        return true;
    }

    public function actionAbout()
    {
        require_once(ROOT . '/views/site/about.php');
        return true;
    }

}
