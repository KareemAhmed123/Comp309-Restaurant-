<?php

//require_once "backend/models/Order.php";


class OrderDao
{
    public function getAll()
    {
        include 'server.php';

        $query = "SELECT * FROM ORDER ";
        $result = $connection->query($query);
        if (!$result) die($connection->error);

        $arr_order = array();
        $rows = $result->num_rows;

        for ($j = 0; $j < $rows; ++$j) {
            $order = new order();
            $result->data_seek($j);
            $order->setorderId($result->fetch_assoc()['id']);
            $result->data_seek($j);
            $order->setPrice($result->fetch_assoc()['price']);
            $result->data_seek($j);
            $order->setStatus($result->fetch_assoc()['status']);
            $result->data_seek($j);
            $order->setUserId($result->fetch_assoc()['userId']);
            $result->data_seek($j);
          
            $arr_order[] = $order;
        }

        $result->close();
        $connection->close();
        return $arr_order;
    }

    public function create($order)
    {
        include 'server.php';

        $order_id = $order->getUserId();
        $order_price = $order->getPrice();
        $order_status = $order->getStatus();


        $query = "INSERT INTO orders (user_id, price, status) VALUES ('$order_id', ' $order_price', '$order_status')";
        $result = $connection->query($query);

        if (!$result) die($connection->error);

        $connection->close();
    }



    public function delete($e_n)
    {
        include 'server.php';

        $query = "DELETE FROM users WHERE id = $u_i";
        $result = $connection->query($query);

        if (!$result) die($connection->error);

        $connection->close();
    }

    public function adminGetConfirmed()
    {
        include 'server.php';
        $confirmed="CONFIRMED";
        $query = "select * from myorder where Status='$confirmed'";


        $result = mysqli_query($connection,$query);


        return $result;
    }
}
