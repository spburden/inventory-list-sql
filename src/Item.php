<?php
    class Item
    {
        private $id;
        private $name;
        private $description;
        private $quantity;

        function __construct($name, $description, $quantity, $id = null)
        {
            $this->name = $name;
            $this->description = $description;
            $this->quantity = $quantity;
            $this->id = $id;
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
            $GLOBALS['DB']->exec("INSERT INTO items (name, description, quantity) VALUES ('{$this->getName()}', '{$this->getDescription()}', {$this->getQuantity()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_items = $GLOBALS['DB']->query("SELECT * FROM items;");
            $items = array();
            foreach($returned_items as $item) {
                $name = $item['name'];
                $description = $item['description'];
                $quantity = $item['quantity'];
                $id = $item['id'];
                $new_item = new Item($name, $description, $quantity, $id);
                array_push($items, $new_item);
                }
            return $items;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM items;");
        }

        static function find ($search_id)
        {
            $found_item = null;
            $items = Item::getAll();
            foreach($items as $item) {
                $item_id = $item->getId();
                if ($item_id == $search_id) {
                    $found_item = $item;
                }
                return $found_item;
            }
        }


    }



?>
