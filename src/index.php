<?php 
require 'vendor/autoload.php';
require 'plugins/NotORM.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}

/* Database Configuration */
$dbhost   = 'localhost';
$dbuser   = 'root';
$dbpass   = '';
$dbname   = 'kambingsoondb';
$dbmethod = 'mysql:dbname=';

$dsn = $dbmethod.$dbname;
$pdo = new PDO($dsn, $dbuser, $dbpass);
$db = new NotORM($pdo);

$app-> get('/', function(){
    echo "Hello World";
});

// instead of mapping:
// $app->options('/(:x+)', function() use ($app) {
//     //...return correct headers...
//     $app->response->setStatus(200);
// });

//==========================================
//	MENU SERVICE
//==========================================

// get all menu
$app->get('/menu/getAll', function() use($app, $db){
    $menus = array();
    foreach ($db->menu() as $menu) {
        $menus[]  = array(
            'id' => $menu['id'],
            'menuName' => $menu['menu_name'],
            'categoryId' => $menu['category_id'],
            'categoryName' => $menu->category['category_name']
        );
    }
    echo json_encode($menus);
});

// get parent menu
$app->get('/menu/getParentMenu', function(Request $request, Response $response) use($app, $db){
    $menus[] = $db->menu()->where('parent_id',null);
    // foreach ($db->menu() as $menu) {
    //     $menus[]  = array(
    //         'id' => $menu['id'],
    //         'menuName' => $menu['menu_name'],
    //         'categoryId' => $menu['category_id'],
    //         'categoryName' => $menu->category['category_name']
    //     );
    // }
    $response->getBody()->write(json_encode($menus));
    return $response;
});

// get menu by parent
$app->get('/menu/getByParent', function(Request $request, Response $response) use($app, $db){
	$params = $request->getQueryParams();
    // $menus[] = $db->menu()->where('parent_id',$params['parentId']);
	$menus = array();
    foreach ($db->menu()->where('parent_id',$params['parentId']) as $menu) {
        $menus[]  = array(
            'id' => $menu['id'],
            'menuName' => $menu['menu_name'],
            'price' => $menu['price'],
            'description' => $menu['description'],
            'categoryId' => $menu['category_id'],
            'categoryName' => $menu->category['category_name']
        );
    }
	$response->getBody()->write(json_encode($menus));
	return $response;
});

// get menu by category
$app->get('/menu/getByCategory', function(Request $request, Response $response) use($app, $db){
    $params = $request->getQueryParams();
	$menus = $db->menu()->where('category_id',$params['categoryId']);

	$response->getBody()->write(json_encode($menus));
	return $response;
});
//==========================================
//	.END MENU SERVICE
//==========================================

//run App
$app->run();