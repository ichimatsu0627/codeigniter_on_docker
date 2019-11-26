<?php
require_once(APPPATH."models/Tran_model.php");

/**
 * Class T_productions
 */
class T_productions extends Tran_model
{
    /**
     * update_num
     * @param $id
     * @param $num
     * @throws Exception
     */
    public function update_num($id, $num)
    {
        $sql = "
            UPDATE
                `t_productions`
            SET
                `num` = ?
            WHERE
                `id` = ?
        ";

        $this->query_to_master($sql, [$num, $id]);
    }
}
