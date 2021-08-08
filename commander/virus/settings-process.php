<?php
require_once '../../core/init.php';
$general = new CadetConsole();
$show = new Show();
$general = new General();
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllLGA') {

	$output = '';

      $dat = $general->selectTable('allLGAInNig', 0);

      if ($dat) {

        $output .= '
        <table class="table table-striped table-hover" id="showLGA">
          <thead>
            <tr>
              <th>#</th>
              <th>LGA</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>
        ';
        foreach ($dat as $row) {

          $output .= '
              <tr>
                <td>'.$row->id.'</td>

      		 <td>'.$row->lga.'</td>

         <td>
         <a href="#" id="'.$row->id.'" title="Trash" class="text-danger lgaTrashIcon" ><i class="fas fa-recycle fa-lg"></i> </a>&nbsp;

              <a href="#" id="'.$row->id.'" title="Edit" class="text-success editLGABtn" data-toggle="modal" data-target="#editLGAModal"><i class="fas fa-edit fa-lg"></i> </a>
         </td>
              </tr>
              ';
        }



        $output .= '
          </tbody>
        </table>';
        echo $output;
      }else{
        echo '<h3 class="text-center text-secondary align-self-center lead">No Data In database</h3>';
      }

}

if (isset($_POST['action']) && $_POST['action'] == 'add_lga') {

	$lga = $_POST['lga'];

	$add = $general->insertLga($lga);

}
