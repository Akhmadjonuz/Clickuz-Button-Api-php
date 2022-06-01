<?php
date_default_timezone_set("Asia/Tashkent");
class Mylib
{
  public $host = 'localhost';
  public $user = 'srv2';
  public $pass = '7I9b2U2j';
  public $dbname = 'srv2';
  public $db;    
  // public $time = date("d.m.Y H:i:s");

 


  //connect to database
  public function db()
  {
  
    $this->db = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
    if(!$this->db)
    {
      echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
      echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
      echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
      exit;
    }
  return $this->db;
  }

//headers 
  public function headers()
  {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-credentials: true");
    header("Access-Control-Max-Age: 86400");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
  }
//headers 2
  public function headers2()
  {
    echo'   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UzGER Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
  
    <link rel="stylesheet" href="'.$this->domen.'admin/styles.css">
  </head>';
  }
//query database
  public function query($query)
  {
    $result = mysqli_query($this->db(), $query);
    return $result;
  }


//fetch_array from database
  public function fetch_array($result)
  {
    return mysqli_fetch_array($result);
  }


//fetch_assoc from database
    public function fetch_assoc($result)
    {
        return mysqli_fetch_assoc($result);
    }


//num_rows from database
  public function num_rows($result)
  {
    return mysqli_num_rows($result);
  }


//insert data to database
  public function insert($table, $data)
  {
    $i = 0;
    $columns = '';
    $values = '';
    foreach ($data as $key => $value) {
      if ($i == 0) {
        $columns .= $key;
        $values .= "'$value'";
      } else {
        $columns .= ', ' . $key;
        $values .= ", '$value'";
      }
      $i++;
    }
  
    $query = "INSERT INTO $table ($columns) VALUES ($values)";
    $result = $this->query($query);
    return $result;
  }


//update data to database
  public function update($table, $data, $where)
  {
    $i = 0;
    $values = '';
    foreach ($data as $key => $value) {
      if ($i == 0) {
        $values .= $key . "='" . $value . "'";
      } else {
        $values .= ', ' . $key . "='" . $value . "'";
      }
      $i++;
    }
          //multi where
          if (is_array($where)) {
            $i = 0;
            $where_values = '';
            foreach ($where as $key => $value) {
              if ($i == 0) {
                $where_values .= $key . "='" . $value . "'";
              } else {
                $where_values .= ' AND ' . $key . "='" . $value . "'";
              }
              $i++;
            }
            $where = $where_values;
          }
    $query = "UPDATE $table SET $values WHERE $where";
    $result = $this->query($query);
    return $result;
  }


//delete data to database
  public function delete($table, $where)
  {
        //multi where
        if (is_array($where)) {
          $i = 0;
          $where_values = '';
          foreach ($where as $key => $value) {
            if ($i == 0) {
              $where_values .= $key . "='" . $value . "'";
            } else {
              $where_values .= ' AND ' . $key . "='" . $value . "'";
            }
            $i++;
          }
          $where = $where_values;
        }
    $query = "DELETE FROM $table WHERE $where";
    $result = $this->query($query);
    return $result;
  }


//select data from database
  public function select_not($table, $where)
  {
    //multi where
    if (is_array($where)) {
      $i = 0;
      $where_values = '';
      foreach ($where as $key => $value) {
        if ($i == 0) {
          $where_values .= $key . "!='" . $value . "'";
        } else {
          $where_values .= ' AND ' . $key . "!='" . $value . "'";
        }
        $i++;
      }
      $where = $where_values;
    }
    $query = "SELECT * FROM $table WHERE $where";
    $result = $this->query($query);
    return $result;
  }
  public function select($table, $where)
  {
    //multi where
    if (is_array($where)) {
      $i = 0;
      $where_values = '';
      foreach ($where as $key => $value) {
        if ($i == 0) {
          $where_values .= $key . "='" . $value . "'";
        } else {
          $where_values .= ' AND ' . $key . "='" . $value . "'";
        }
        $i++;
      }
      $where = $where_values;
    }
    $query = "SELECT * FROM $table WHERE $where";
    $result = $this->query($query);
    return $result;
  }

//select_all data from database
  public function select_all($table)
  {
    $query = "SELECT * FROM $table";
    $result = $this->query($query);
    return $result;
  }


  //log out
  public function logout()
  {
    session_destroy();
    header('location: /');
  }




  //check sql injection
    public function check($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //send curl request
    public function send_curl_request($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }



  public function get_object($get, $table, $array)
  {
    if(isset($_GET[$get]))
    {
        if($array == null)
        {
            $result = $this->select_all($table);
            echo '[';
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
            }
            echo ']';
            exit;
        }else{
            $result = $this->select($table, $array);
            echo '[';
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
            }
            echo ']';
            exit;
        }
    }

    
  } 
  
  public function get_object2($get, $table, $array)
  {
    if(isset($_GET[$get]))
    {
      $result = $this->select_not($table, $array);
      echo '[';
      for ($i = 0; $i < mysqli_num_rows($result); $i++) {
          echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
      }
      echo ']';
      exit;
    }

  }



}