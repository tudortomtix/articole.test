<?php
/**
 * Clasa BaseController sta la baza fiecarui Controller din aplicatie
 * si contine functionalitati generale oricarui controller
 */
namespace framework;

class BaseController
{
    // Render un array cu continut intr-un anumit view (fisier HTML)
    public function render($view, $vars = array())
    {
        if (strpos($view, 'pages'.DIRECTORY_SEPARATOR) === 0) {            
            $view_file = VIEWS_PATH.DIRECTORY_SEPARATOR.$view.'.php';    
        } else {            
            $view_file = VIEWS_PATH.$this->getViewFolder().DIRECTORY_SEPARATOR.$view.'.php';            
        }
        
        if(is_file($view_file)){
            // returneaza continutul unui fisier intr-o variabila
            ob_start();
            ob_implicit_flush(false);
            require $view_file;
            $content = ob_get_clean();
            // incarca continutul view-ului in tema
            $this->loadTheme($content);
        }else{          
            $this->render('pages'.DIRECTORY_SEPARATOR.'404');
        }   
    }

    protected function loadTheme($content)
    {
        require THEME_PATH.Framework::$params['theme'].DIRECTORY_SEPARATOR.'index.php';
    }

    /**
    * Folderul unde se afla view-ul se obtine din numele clasei Controller-ului
    * care a extins BaseController
    */
    protected function getViewFolder(){ 
        $child_class = get_called_class();
        $end_pos = strpos($child_class, 'Controller');
        $start_pos = strrpos($child_class, '\\');
        return strtolower(substr($child_class, $start_pos+1, $end_pos-$start_pos-1));
    }

    function redirect($redirect)
    {
        if(!empty($redirect)){
            header("Location: $redirect");
            exit();
        }       
    }
}