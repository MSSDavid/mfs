<?php
/**
 * This classe is used as an interface for model classes.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 10/10/2017
 * @since   0.1
 */
class model{

    /**
     * The object for database controls.
     */
    protected $db;

    /**
     * The constructor for models.
     */
    public function __construct(){
        global $db;
        $this->db = $db;
    }
}