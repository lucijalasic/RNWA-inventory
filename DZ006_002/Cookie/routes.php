<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');
    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
	    case 'category':
        require_once('models/category.php');
		$controller = new CategoryController();
      break;
      case 'product':
        require_once('models/product.php');
		$controller = new ProductController();
      break;
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('pages' 		=> ['home', 'error'],
                       'category' 	=> ['index','verifyinsert','insert','verifyupdate','update','delete','verifydelete'],
                       'product' 	=> ['index','verifyinsert','insert','verifyupdate','update','delete','verifydelete']);

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      // echo "Hoj";
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>