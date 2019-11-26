<div style="margin-top: 50px; margint-left: 10%;">
    <table>
        <tr>
            <th>ID</th>
            <th>商品名</th>
            <th>値段</th>
            <th>個数</th>
            <th></th>
        </tr>
        <?php foreach($t_productions as $t_production) { ?>
            <tr>
                <td><?php echo $t_production->m_production_id;?></td>
                <td><?php echo $m_productions[$t_production->m_production_id]->name ?? "";?></td>
                <td><?php echo $t_production->price;?></td>
                <td><?php echo $t_production->num;?></td>
                <td><a href="/market/sell?id=<?php echo $t_production->id;?>&num=1"><button>売却</button></a></td>
            </tr>
        <?php } ?>
    </table>
</div>

<script>
    <?php if (!empty($pop_message)) { ?>
      alert("<?php echo $pop_message ;?>");
    <?php } ?>
</script>
