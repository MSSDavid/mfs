<?php
/**
 * This class retrieves and saves data of the Brazil's states.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 16/11/2017
 * @since   0.1
 */
class Estados extends model{

    /**
     * This function retrieves all data from states's database.
     *
     * @return  array containing all data retrieved.
     */
    public function getEstados(){
        $sql = "SELECT * FROM estados ORDER BY uf";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $sql = $sql->fetchAll();
        return $sql;
    }
}