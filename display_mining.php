<?php

function display_process_hasil_mining($db_object, $id_process)
{

    $sql1 = "SELECT * FROM confidence "
        . " WHERE id_process = " . $id_process
        . " AND from_itemset=3 "; //. " ORDER BY lolos DESC";
    $query1 = $db_object->db_query($sql1);
?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Confidence dari itemset 3</h6>
        </div>

        <div class="card-body">

            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th>No</th>
                        <th>X => Y</th>
                        <th>Support X U Y</th>
                        <th>Support X </th>
                        <th>Confidence</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <?php
                $no = 1;
                $data_confidence = array();
                while ($row = $db_object->db_fetch_array($query1)) {
                    echo "<tr>";
                    echo "<td class='text-center'>" . $no . "</td>";
                    echo "<td>" . $row['kombinasi1'] . " => " . $row['kombinasi2'] . "</td>";
                    echo "<td class='text-center'>" . price_format($row['support_xUy']) . "</td>";
                    echo "<td class='text-center'>" . price_format($row['support_x']) . "</td>";
                    echo "<td class='text-center'>" . price_format($row['confidence']) . "</td>";
                    $keterangan = ($row['confidence'] <= $row['min_confidence']) ? "<span class='badge badge-danger'>Tidak Lolos</span>" : "<span class='badge badge-success'>Lolos</span>";
                    echo "<td class='text-center'>" . $keterangan . "</td>";
                    echo "</tr>";
                    $no++;
                    if ($row['lolos'] == 1) {
                        $data_confidence[] = $row;
                    }
                }
                ?>
            </table>
        </div>
    </div>


    <?php
    $sql1 = "SELECT * FROM confidence "
        . " WHERE id_process = " . $id_process
        . " AND from_itemset=2 "; //. " ORDER BY lolos DESC";
    $query1 = $db_object->db_query($sql1);
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Confidence dari itemset 2</h6>
        </div>

        <div class="card-body">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th>No</th>
                        <th>X => Y</th>
                        <th>Support X U Y</th>
                        <th>Support X </th>
                        <th>Confidence</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <?php
                $no = 1;
                //$data_confidence = array();
                while ($row = $db_object->db_fetch_array($query1)) {
                    echo "<tr>";
                    echo "<td class='text-center'>" . $no . "</td>";
                    echo "<td>" . $row['kombinasi1'] . " => " . $row['kombinasi2'] . "</td>";
                    echo "<td class='text-center'>" . price_format($row['support_xUy']) . "</td>";
                    echo "<td class='text-center'>" . price_format($row['support_x']) . "</td>";
                    echo "<td class='text-center'>" . price_format($row['confidence']) . "</td>";
                    $keterangan = ($row['confidence'] <= $row['min_confidence']) ? "<span class='badge badge-danger'>Tidak Lolos</span>" : "<span class='badge badge-success'>Lolos</span>";
                    echo "<td class='text-center'>" . $keterangan . "</td>";
                    echo "</tr>";
                    $no++;
                    if ($row['lolos'] == 1) {
                        $data_confidence[] = $row;
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Rule Asosiasi yang terbentuk</h6>
        </div>

        <div class="card-body">

            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th>No</th>
                        <th>X => Y</th>
                        <th>Confidence</th>
                        <th>Nilai Uji lift</th>
                        <th>Korelasi rule</th>
                        <!-- <th></th> -->
                    </tr>
                </thead>
                <?php

                $no = 1;
                //while ($row1 = $db_object->db_fetch_array($query1)) {
                foreach ($data_confidence as $key => $val) {
                    echo "<tr>";
                    echo "<td class='text-center'>" . $no . "</td>";
                    echo "<td>" . $val['kombinasi1'] . " => " . $val['kombinasi2'] . "</td>";
                    echo "<td class='text-center'>" . price_format($val['confidence']) . "</td>";
                    echo "<td class='text-center'>" . price_format($val['nilai_uji_lift']) . "</td>";
                    echo "<td class='text-center'>" . ($val['korelasi_rule']) . "</td>";
                    //echo "<td>" . ($val['lolos'] == 1 ? "Lolos" : "Tidak Lolos") . "</td>";
                    echo "</tr>";
                    $no++;
                }
                ?>
            </table>
        </div>
    </div>

<?php
}
?>