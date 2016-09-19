<?php
    class Item
    {
        private $id;
        private $name;
        private $description;
        private $quantity;

        function __construct($id = null, $name, $description = null, $quantity = 1)
        {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->quantity = $quantity;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function setQuantity($new_quantity)
        {
            $this->quantity = (int) $new_quantity;
        }

        function getQuantity()
        {
            return $this->quantity;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO items (name, description, quantity) VALUES ('{$this->getName()}', '{$this->getDescription()}', {$this->getQuantity()})");
            // $GLOBALS['DB']->exec("INSERT INTO items (description) VALUES ('{$this->getDescription()}')");
            // $GLOBALS['DB']->exec("INSERT INTO items (quantity) VALUES ('{$this->getQuantity()}')");
        }

        static function getAll()
        {
            $returned_items = $GLOBALS['DB']->query("SELECT * FROM tasks;");
            $items = array();
            foreach($returned_items as $item) {
                $id = $item['id'];
                $name = $item['name'];
                $description = $item['description'];
                $quantity = $item['quantity'];
                $new_item = new Item($id, $name, $description, $quantity);
                array_push($items, $new_item);
                }
        return $items;    
        }




?>
