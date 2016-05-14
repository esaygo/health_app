<?php

class User extends CI_Model {
  function add_user($new_user) {
      $query = 'INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?,NOW(),NOW())';
      $values = array($new_user['first_name'], $new_user['last_name'], $new_user['email'], $new_user['password']);
      return $this->db->query($query, $values);
  }

  function get_user($new_user) {
      $query = "SELECT * FROM users WHERE email = ?";
      $user_info = $this->db->query($query, $new_user['email'])->row_array();
      return $user_info;
  }

  function get_user_login($existing_user) {
    $query = "SELECT * FROM users WHERE email = ? AND password = ? ";
    $values = array($existing_user['email'], $existing_user['password']);
    $user_info = $this->db->query($query, $values)->row_array();
    return $user_info;
  }

  function get_all_users() {
    $query = "SELECT * FROM users";
    $all_users = $this->db->query($query)->result_array();
    return $all_users;
  }

  function add_interest($user_info, $new_user){
    // $query = 'INSERT INTO users_categories (user_id, category_id) VALUES (?,?)';
    // $values = array($user_info['id'], $new_user['interest'][0]);
    // for($i=1; $i<count($new_user['interest']); $i++){
    //   $query .= ', (?,?)';
    //   $values = array_push($values, $user_info['id'], $new_user['interest'][$i]);
    // }
    // $this->db->query($query, $values);
    for($i=0; $i<count($new_user['interest']); $i++){
      $query = 'INSERT INTO users_categories (user_id, category_id) VALUES (?,?)';
      $values = array($user_info['id'], $new_user['interest'][$i]);
      $this->db->query($query, $values);
    }
  }

  function get_interests($user_info){
    $query = "SELECT users_categories.user_id, users_categories.category_id, categories.type FROM users_categories
              LEFT JOIN categories ON users_categories.category_id = categories.id
              WHERE user_id = ?";
    $values = array($user_info['id']);
    $interest_info = $this->db->query($query, $values)->result_array();
    return $interest_info;
  }

  function get_all_interests($user_id) {
    $query = "SELECT users_categories.user_id AS user_id, users_categories.category_id AS category_id, categories.type AS interest FROM categories
              LEFT JOIN users_categories
              ON users_categories.category_id = categories.id
              WHERE users_categories.user_id = '{$user_id}'";
    $all_interests = $this->db->query($query)->result_array();
    return $all_interests;
  }

  function get_all_products() {
    $query = "SELECT * FROM products";
    $all_products = $this->db->query($query)->result_array();
    return $all_products;
  }

  function get_product_by_id($product_id) {
    $query = "SELECT * FROM products WHERE id = '{$product_id}'";
    $product = $this->db->query($query)->row_array();
    return $product;
  }

  function get_products($loggedin_user_id) {
    $query = 'SELECT users.first_name, users.id as user_id, categories.type, products.id as prod_id, products.item, products.description,products.price,
              products.picture, products.stock FROM products INNER JOIN products_categories ON products.id = products_categories.product_id
					    INNER JOIN categories ON products_categories.category_id = categories.id
              INNER JOIN users_categories ON users_categories.category_id = categories.id
              INNER JOIN users ON users_categories.user_id = users.id WHERE users.id=?';
    $values = array($loggedin_user_id);
    $products = $this->db->query($query, $values)->result_array();
    return $products;
  }

  // function get_all_interested_products($interests){
  //   $query = "SELECT products.id, products.item, products.description, products.price, products.picture, products_categories.category_id FROM products
  //             LEFT JOIN products_categories ON products.id = products_categories.product_id
  //             LEFT JOIN categories ON products_categories.category_id = categories.id
  //             WHERE categories.id = 1 OR categories.id = 2";
  //   $all_products = $this->db->query($query)->result_array();
  //   return $all_products;
  // }

  function add_to_cart($cart_data) {
    $query = 'INSERT INTO cart (quantity, product_id, created_at, updated_at, users_id) VALUES (?,?,NOW(),NOW(),?)';
    $values = array($cart_data['quantity'], $cart_data['product_id'], $cart_data['user_id']);
    return $this->db->query($query, $values);
  }

  function deduct_stock($cart_data) {
    $query = "UPDATE products SET stock = stock - '{$cart_data['quantity']}' WHERE id = '{$cart_data['product_id']}'";
    return $this->db->query($query);
  }

  function get_cart($loggedin_user_id) {
    $query = "SELECT products.item, products.description,products.price,
              SUM(cart.quantity) as qty,
              SUM(cart.quantity * products.price) AS grand_total FROM
              products INNER JOIN cart ON cart.product_id = products.id
              INNER JOIN users ON cart.users_id = users.id WHERE
              users.id = ? GROUP BY products.id";
    $values = array($loggedin_user_id);
    $cart = $this->db->query($query, $values)->result_array();
    return $cart;
  }

  function empty_cart($id) {
    $query = "DELETE FROM cart WHERE cart.users_id = ? ";
    $values = array($id);
    return $this->db->query($query,$values);
  }
}
