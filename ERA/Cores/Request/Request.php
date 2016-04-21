<?php namespace ERA\Core;

class Request extends \Singleton {
      public function getRequest($type = 'POST', $key = null) {
            switch ($type) {
                  case 'GET':
                        $response = ($key) ? $_GET[$key] : (object)$_GET;
                  break;
                  case 'FILE':
                        $response = ($key) ? $_FILES[$key] : (object)$_FILES;
                  break;
                  case 'POST':
                        $response = ($key) ? $_POST[$key] : (object)$_POST;
                  break;
                  case 'PUT':
                        $response = ($key) ? $_PUT[$key] : (object)$_PUT;
                  break;
                  case 'REQUEST':
                        $response = ($key) ? $_REQUEST[$key] : (object)$_REQUEST;
                  break;
                  case 'DELETE':
                        $response = ($key) ? $_DELETE[$key] : (object)$_DELETE;
                  break;
            }
            return $response;
      }

      public function validMethod($type = 'POST') {
            return ($_SERVER['REQUEST_METHOD'] == $type) ? 1 : 0;
      }

      public function file($key = null){
            return $this->getRequest('FILE', $key);
      }

      /*
      * POST
      * Create
      * 201 (Created), 'Location' header with link to /customers/{id} containing new ID.
      * 404 (Not Found), 409 (Conflict) if resource already exists..
      */
      public function post($key = null){
            return $this->getRequest('POST', $key);
      }

      /*
      * GET
      * Read
      * 200 (OK), list of customers. Use pagination, sorting and filtering to navigate big lists.
      * 200 (OK), single customer. 404 (Not Found), if ID not found or invalid.
      */
      public function get($key = null){
            return $this->getRequest('GET', $key);
      }

      /*
      * PUT
      * Update
      * 404 (Not Found), unless you want to update/replace every resource in the entire collection.
      * 200 (OK) or 204 (No Content). 404 (Not Found), if ID not found or invalid.
      */
      public function put($key = null){
            return $this->getRequest('PUT', $key);
      }

      /*
      * DELETE
      * Delete
      * 404 (Not Found), unless you want to delete the whole collection—not often desirable.
      * 200 (OK). 404 (Not Found), if ID not found or invalid.
      */
      public function delete($key = null) {
            return $this->getRequest('DELETE', $key);
      }

      public function req($key = null) {
            return $this->getRequest('REQUEST', $key);
      }

      public function isPost(){
            return $_POST ? 1 : 0;
      }

      public function isGet(){
            return $_GET ? 1 : 0;
      }

      public function isReq(){
            return $_REQUEST ? 1 : 0;
      }

      public function isFile(){
            return $_FILES ? 1 : 0;
      }
}

?>