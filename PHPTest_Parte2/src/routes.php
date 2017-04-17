<?php
// Routes

// views
$app->get('/index/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/list', function ($request, $response) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    
    $employees = $this->jsondb;
    $getVars = $request->getQueryParams();
    if (isset($getVars['email'])) {
        $email = $getVars['email'];
        $employees_email = array();
        foreach($employees as $employee) {
            if ($employee['email'] == $email) {
                $employees_email[] = $employee;
                break;
            }
        }  
        return $this->renderer->render($response, 'list.phtml', ["employees" => $employees_email]);
    }
    else {
        return $this->renderer->render($response, 'list.phtml', ["employees" => $employees]);
    }
});

$app->get('/details/[{id}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // busca un empleado por id parametro
    $employees = $this->jsondb;
    foreach($employees as $employee) {
        if ($employee['id'] == $args['id']) {
            $employee_detail = $employee;
            break;
        }
    }

    // Render index view
    return $this->renderer->render($response, 'details.phtml', ["employee" => $employee_detail]);
});

// apis
$app->get('/api/employeeSalary/{min}/{max}', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    
    $employees = $this->jsondb;
    $employees_salary = array();
    $min_salary = (float)$args['min'];
    $max_salary = (float)$args['max'];
    foreach($employees as $employee) {
        $salary = (float)str_replace(array(",","$"), "", $employee['salary']);
        if ($salary >= $min_salary && $salary <= $max_salary) {
            $employees_salary[] = $employee;
        }
    }
    return $this->renderer->render($response, 'dataxml.phtml', ["employees" => $employees_salary])->withHeader('Content-Type', 'application/xml');
});

$app->get('/api/json', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    
    $employees = $this->jsondb;
    return $this->response->withJson($employees);
});
