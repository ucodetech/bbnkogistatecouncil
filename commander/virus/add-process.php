<?php
require_once '../../core/init.php';
$general = new General();
$show = new Show();
$notify = new Notification();


if (isset($_POST['action']) && $_POST['action'] == 'add_presidentState') {

    $pre_name = $show->test_input($_POST['pre_name']);
    $pre_served_start = $_POST['pre_served_start'];
    $pre_served_end = $_POST['pre_served_end'];

    $required = array(
      'pre_name',
      'pre_served_start',
      'pre_served_end'
    );
    foreach ($required as $field) {
      if (empty($_POST[$field])) {
        echo $show->showMessage('danger', 'No field should be left blank!', 'warning');
        return false;
      }
    }

    $general->addStateExecutives('statePresidents',array(
      'pre_name' => $pre_name,
       'served_start_date' => $pre_served_start,
       'served_finish_date' => $pre_served_end
     ));
        echo 'success';


}

if (isset($_POST['action']) && $_POST['action'] == 'fetchData') {

  $data = $general->selectTable('statePresidents', 0);
  $output = '';

  if ($data) {
    $output .= '<table class="table table-striped table-hover" id="showPr">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Started</th>
          <th>Finised</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>';
      $x = 0;
      $date = date('Y');
      foreach ($data as $presremb) {
        if ($presremb->served_finish_date > $date) {
          $tilNow = '<span class="text-info">To Date</span>';

        }else{
          $tilNow = pretty_dated($presremb->served_finish_date);
        }
        $x = $x + 1;
        $output .= '

            <tr>
              <td>'.$x.'</td>

             <td>'.$presremb->pre_name.'</td>
               <td>'.pretty_dated($presremb->served_start_date).'</td>
               <td>'.$tilNow.'</td>

               <td>

                 <a href="#" id="'.$presremb->id.'" title="Edit Presidents" class="text-success editPIcon" ><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#editPs"></i></a>&nbsp;
               <a href="#" id="'.$presremb->id.'" title="Trash Presidents" class="text-danger trashPIcon"><i class="fas fa-recycle fa-lg"></i> </a>

               </td>
              </tr>
              ';

        }

                $output .= '
                  </tbody>
                </table>';
          echo $output;
    }else{
      echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
    }

  }



  if (isset($_POST['action']) && $_POST['action'] == 'add_vpresidentState') {

      $vpre_name = $general->test_input($_POST['vpre_name']);
      $vpre_served_start = $_POST['vpre_served_start'];
      $vpre_served_end = $_POST['vpre_served_end'];

      $required = array(
        'vpre_name',
        'vpre_served_start',
        'vpre_served_end'
      );
      foreach ($required as $field) {
        if (empty($_POST[$field])) {
          echo $general->showMessage('danger', 'No field should be left blank!');
          return false;
        }
      }

      $add = $general->addStateExecutives('stateVicePresidents', 'pre_name', 'served_start_date','served_finish_date',$vpre_name,$vpre_served_start, $vpre_served_end );
      if ($add) {
          echo 'success';
      }

  }

  if (isset($_POST['action']) && $_POST['action'] == 'fetchDataVp') {

    $data = $general->selectTable('stateVicePresidents', 0);
    $output = '';

    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showVPr">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Started</th>
            <th>Finised</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
        $date = date('Y');
        foreach ($data as $presremb) {
          if ($presremb->served_finish_date > $date) {
            $tilNow = '<span class="text-info">To Date</span>';

          }else{
            $tilNow = pretty_dated($presremb->served_finish_date);
          }
          $x = $x + 1;
          $output .= '

              <tr>
                <td>'.$x.'</td>

               <td>'.$presremb->pre_name.'</td>
                 <td>'.pretty_dated($presremb->served_start_date).'</td>
                 <td>'.$tilNow.'</td>

                 <td>

                   <a href="#" id="'.$presremb->id.'" title="Edit VPs" class="text-success editVpIcon" data-toggle="modal" data-target="#editVPs"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
                 <a href="#" id="'.$presremb->id.'" title="Trash VPs" class="text-danger trashVPIcon"><i class="fas fa-recycle fa-lg"></i> </a>

                 </td>
                </tr>
                ';

          }

                  $output .= '
                    </tbody>
                  </table>';
            echo $output;
      }else{
        echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
      }

    }




  if (isset($_POST['action']) && $_POST['action'] == 'add_ssoState') {

        $sso_name = $general->test_input($_POST['sso_name']);
        $sso_served_start = $_POST['sso_served_start'];
        $sso_served_end = $_POST['sso_served_end'];

        $required = array(
          'sso_name',
          'sso_served_start',
          'sso_served_end'
        );
        foreach ($required as $field) {
          if (empty($_POST[$field])) {
            echo $general->showMessage('danger', 'No field should be left blank!');
            return false;
          }
        }

        $add = $general->addStateExecutives('stateSSO', 'sso_name', 'served_start_date','served_finish_date',$sso_name,$sso_served_start, $sso_served_end );
        if ($add) {
            echo 'success';
        }

    }

    if (isset($_POST['action']) && $_POST['action'] == 'fetchDataSSO') {

      $data = $general->selectTable('stateSSO', 0);
      $output = '';

      if ($data) {
        $output .= '<table class="table table-striped table-hover" id="showSSOState">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Started</th>
              <th>Finised</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>';
          $x = 0;
          $date = date('Y');
          foreach ($data as $presremb) {
            if ($presremb->served_finish_date > $date) {
              $tilNow = '<span class="text-info">To Date</span>';

            }else{
              $tilNow = pretty_dated($presremb->served_finish_date);
            }
            $x = $x + 1;
            $output .= '

                <tr>
                  <td>'.$x.'</td>

                 <td>'.$presremb->sso_name.'</td>
                   <td>'.pretty_dated($presremb->served_start_date).'</td>
                   <td>'.$tilNow.'</td>

                   <td>

                     <a href="#" id="'.$presremb->id.'" title="Edit VPs" class="text-success editSSOIcon" data-toggle="modal" data-target="#editSSO"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
                   <a href="#" id="'.$presremb->id.'" title="Trash VPs" class="text-danger trashSSOIcon"><i class="fas fa-recycle fa-lg"></i> </a>

                   </td>
                  </tr>
                  ';

            }

                    $output .= '
                      </tbody>
                    </table>';
              echo $output;
        }else{
          echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
        }

      }


if (isset($_POST['action']) && $_POST['action'] == 'add_assoState') {

              $asso_name = $show->test_input($_POST['asso_name']);
              $asso_served_start = $_POST['asso_served_start'];
              $asso_served_end = $_POST['asso_served_end'];

              $required = array(
                'asso_name',
                'asso_served_start',
                'asso_served_end'
              );
              foreach ($required as $field) {
                if (empty($_POST[$field])) {
                  echo $show->showMessage('danger', 'No field should be left blank!','warning');
                  return false;
                }
              }

              $general->addStateExecutives('stateASSO',array(
                'asso_name' => $asso_name,
                 'served_start_date' => $asso_served_start,
                 'served_finish_date' => $asso_served_end
               ));
                  echo 'success';

          }

  if (isset($_POST['action']) && $_POST['action'] == 'fetchDataASSO') {

            $data = $general->selectTable('stateASSO', 0);
            $output = '';

            if ($data) {
              $output .= '<table class="table table-striped table-hover" id="showASSOState">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Started</th>
                    <th>Finised</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>';
                $x = 0;
                $date = date('Y');
                foreach ($data as $presremb) {
                  if ($presremb->served_finish_date > $date) {
                    $tilNow = '<span class="text-info">To Date</span>';

                  }else{
                    $tilNow = pretty_dated($presremb->served_finish_date);
                  }
                  $x = $x + 1;
                  $output .= '

                      <tr>
                        <td>'.$x.'</td>

                       <td>'.$presremb->asso_name.'</td>
                         <td>'.pretty_dated($presremb->served_start_date).'</td>
                         <td>'.$tilNow.'</td>

                         <td>

                           <a href="#" id="'.$presremb->id.'" title="Edit VPs" class="text-success editASSOIcon" data-toggle="modal" data-target="#editASSO"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
                         <a href="#" id="'.$presremb->id.'" title="Trash ASSO" class="text-danger trashASSOIcon"><i class="fas fa-recycle fa-lg"></i> </a>

                         </td>
                        </tr>
                        ';

                  }

                          $output .= '
                            </tbody>
                          </table>';
                    echo $output;
              }else{
                echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
              }

            }


if (isset($_POST['action']) && $_POST['action'] == 'add_treState') {

      $tre_name = $show->test_input($_POST['tre_name']);
      $tre_served_start = $_POST['tre_served_start'];
      $tre_served_end = $_POST['tre_served_end'];

      $required = array(
        'tre_name',
        'tre_served_start',
        'tre_served_end'
      );
      foreach ($required as $field) {
        if (empty($_POST[$field])) {
          echo $show->showMessage('danger', 'No field should be left blank!','warning');
          return false;
        }
      }

      $general->addStateExecutives('stateTreasures',array(
        'tre_name' => $tre_name,
         'served_start_date' => $tre_served_start,
         'served_finish_date' => $tre_served_end
       ));
          echo 'success';

  }

if (isset($_POST['action']) && $_POST['action'] == 'fetchDataTreasures') {

    $data = $general->selectTable('stateTreasures', 0);
    $output = '';

    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showTreasuresState">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Started</th>
            <th>Finised</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
        $date = date('Y');
        foreach ($data as $presremb) {
          if ($presremb->served_finish_date > $date) {
            $tilNow = '<span class="text-info">To Date</span>';

          }else{
            $tilNow = pretty_dated($presremb->served_finish_date);
          }
          $x = $x + 1;
          $output .= '

              <tr>
                <td>'.$x.'</td>

               <td>'.$presremb->tre_name.'</td>
                 <td>'.pretty_dated($presremb->served_start_date).'</td>
                 <td>'.$tilNow.'</td>

                 <td>

                   <a href="#" id="'.$presremb->id.'" title="Edit Treasure" class="text-success editTreasureIcon" data-toggle="modal" data-target="#editTreasure"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
                 <a href="#" id="'.$presremb->id.'" title="Trash Treasure" class="text-danger trashTreasureIcon"><i class="fas fa-recycle fa-lg"></i> </a>

                 </td>
                </tr>
                ';

          }

                  $output .= '
                    </tbody>
                  </table>';
            echo $output;
      }else{
        echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
      }

    }

if (isset($_POST['action']) && $_POST['action'] == 'add_finState') {

          $fs_name = $show->test_input($_POST['fs_name']);
          $fs_served_start = $_POST['fs_served_start'];
          $fs_served_end = $_POST['fs_served_end'];

          $required = array(
            'fs_name',
            'fs_served_start',
            'fs_served_end'
          );
          foreach ($required as $field) {
            if (empty($_POST[$field])) {
              echo $show->showMessage('danger', 'No field should be left blank!','warning');
              return false;
            }
          }

          $general->addStateExecutives('stateFinSec',array(
            'fs_name' => $fs_name,
             'served_start_date' => $fs_served_start,
             'served_finish_date' => $fs_served_end
           ));
              echo 'success';

      }

if (isset($_POST['action']) && $_POST['action'] == 'fetchDataFin') {

        $data = $general->selectTable('stateFinSec', 0);
        $output = '';

        if ($data) {
          $output .= '<table class="table table-striped table-hover" id="showFinState">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Started</th>
                <th>Finised</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>';
            $x = 0;
            $date = date('Y');
            foreach ($data as $presremb) {
              if ($presremb->served_finish_date > $date) {
                $tilNow = '<span class="text-info">To Date</span>';

              }else{
                $tilNow = pretty_dated($presremb->served_finish_date);
              }
              $x = $x + 1;
              $output .= '

                  <tr>
                    <td>'.$x.'</td>

                   <td>'.$presremb->fs_name.'</td>
                     <td>'.pretty_dated($presremb->served_start_date).'</td>
                     <td>'.$tilNow.'</td>

                     <td>

                       <a href="#" id="'.$presremb->id.'" title="Edit Treasure" class="text-success editTreasureIcon" data-toggle="modal" data-target="#editTreasure"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
                     <a href="#" id="'.$presremb->id.'" title="Trash Treasure" class="text-danger trashTreasureIcon"><i class="fas fa-recycle fa-lg"></i> </a>

                     </td>
                    </tr>
                    ';

              }

                      $output .= '
                        </tbody>
                      </table>';
                echo $output;
          }else{
            echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
          }

        }

if (isset($_POST['action']) && $_POST['action'] == 'add_audState') {

    $aud_name = $show->test_input($_POST['aud_name']);
    $aud_served_start = $_POST['aud_served_start'];
    $aud_served_end = $_POST['aud_served_end'];

    $required = array(
      'aud_name',
      'aud_served_start',
      'aud_served_end'
    );
    foreach ($required as $field) {
      if (empty($_POST[$field])) {
        echo $show->showMessage('danger', 'No field should be left blank!','warning');
        return false;
      }
    }

    $general->addStateExecutives('stateAuditors',array(
      'aud_name' => $aud_name,
       'served_start_date' => $aud_served_start,
       'served_finish_date' => $aud_served_end
     ));
        echo 'success';

}

if (isset($_POST['action']) && $_POST['action'] == 'fetchDataAud') {

  $data = $general->selectTable('stateAuditors', 0);
  $output = '';

  if ($data) {
    $output .= '<table class="table table-striped table-hover" id="showA">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Started</th>
          <th>Finised</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>';
      $x = 0;
      $date = date('Y');
      foreach ($data as $presremb) {
        if ($presremb->served_finish_date > $date) {
          $tilNow = '<span class="text-info">To Date</span>';

        }else{
          $tilNow = pretty_dated($presremb->served_finish_date);
        }
        $x = $x + 1;
        $output .= '

            <tr>
              <td>'.$x.'</td>

             <td>'.$presremb->aud_name.'</td>
               <td>'.pretty_dated($presremb->served_start_date).'</td>
               <td>'.$tilNow.'</td>

               <td>

                 <a href="#" id="'.$presremb->id.'" title="Edit Treasure" class="text-success editTreasureIcon" data-toggle="modal" data-target="#editTreasure"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
               <a href="#" id="'.$presremb->id.'" title="Trash Treasure" class="text-danger trashTreasureIcon"><i class="fas fa-recycle fa-lg"></i> </a>

               </td>
              </tr>
              ';

        }

                $output .= '
                  </tbody>
                </table>';
          echo $output;
    }else{
      echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
    }

  }


  if (isset($_POST['action']) && $_POST['action'] == 'add_proState') {

      $pro_name = $general->test_input($_POST['pro_name']);
      $pro_served_start = $_POST['pro_served_start'];
      $pro_served_end = $_POST['pro_served_end'];

      $required = array(
        'pro_name',
        'pro_served_start',
        'pro_served_end'
      );
      foreach ($required as $field) {
        if (empty($_POST[$field])) {
          echo $general->showMessage('danger', 'No field should be left blank!');
          return false;
        }
      }

  $add = $general->addStateExecutives('statePROS', 'pro_name', 'served_start_date','served_finish_date',$pro_name,$pro_served_start, $pro_served_end );
      if ($add) {
          echo 'success';
      }

  }

  if (isset($_POST['action']) && $_POST['action'] == 'fetchDataPRO') {

    $data = $general->selectTable('statePROS', 0);
    $output = '';

    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showP">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Started</th>
            <th>Finised</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
        $date = date('Y');
        foreach ($data as $presremb) {
          if ($presremb->served_finish_date > $date) {
            $tilNow = '<span class="text-info">To Date</span>';

          }else{
            $tilNow = pretty_dated($presremb->served_finish_date);
          }
          $x = $x + 1;
          $output .= '

              <tr>
                <td>'.$x.'</td>

               <td>'.$presremb->pro_name.'</td>
                 <td>'.pretty_dated($presremb->served_start_date).'</td>
                 <td>'.$tilNow.'</td>

                 <td>

                   <a href="#" id="'.$presremb->id.'" title="Edit Treasure" class="text-success editTreasureIcon" data-toggle="modal" data-target="#editTreasure"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
                 <a href="#" id="'.$presremb->id.'" title="Trash Treasure" class="text-danger trashTreasureIcon"><i class="fas fa-recycle fa-lg"></i> </a>

                 </td>
                </tr>
                ';

          }

                  $output .= '
                    </tbody>
                  </table>';
            echo $output;
      }else{
        echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
      }

    }

if (isset($_POST['action']) && $_POST['action'] == 'add_doState') {

        $do_name = $show->test_input($_POST['do_name']);
        $do_served_start = $_POST['do_served_start'];
        $do_served_end = $_POST['do_served_end'];

        $required = array(
          'do_name',
          'do_served_start',
          'do_served_end'
        );
        foreach ($required as $field) {
          if (empty($_POST[$field])) {
            echo $show->showMessage('danger', 'No field should be left blank!','warning');
            return false;
          }
        }


        $general->addStateExecutives('stateDO',array(
          'do_name' => $do_name,
           'served_start_date' => $do_served_start,
           'served_finish_date' => $do_served_end
         ));
            echo 'success';
}

if (isset($_POST['action']) && $_POST['action'] == 'fetchDataDO') {

  $data = $general->selectTable('stateDO', 0);
      $output = '';

      if ($data) {
        $output .= '<table class="table table-striped table-hover" id="showD">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Started</th>
              <th>Finised</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>';
          $x = 0;
          $date = date('Y');
          foreach ($data as $presremb) {
            if ($presremb->served_finish_date > $date) {
              $tilNow = '<span class="text-info">To Date</span>';

            }else{
              $tilNow = pretty_dated($presremb->served_finish_date);
            }
            $x = $x + 1;
            $output .= '

                <tr>
                  <td>'.$x.'</td>

                 <td>'.$presremb->do_name.'</td>
                   <td>'.pretty_dated($presremb->served_start_date).'</td>
                   <td>'.$tilNow.'</td>

                   <td>

                     <a href="#" id="'.$presremb->id.'" title="Edit Treasure" class="text-success editTreasureIcon" data-toggle="modal" data-target="#editTreasure"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
                   <a href="#" id="'.$presremb->id.'" title="Trash Treasure" class="text-danger trashTreasureIcon"><i class="fas fa-recycle fa-lg"></i> </a>

                   </td>
                  </tr>
                  ';

            }

                    $output .= '
                      </tbody>
                    </table>';
              echo $output;
        }else{
          echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
        }

      }

if (isset($_POST['action']) && $_POST['action'] == 'add_pcState') {

          $pc_name = $show->test_input($_POST['pc_name']);
          $pc_served_start = $_POST['pc_served_start'];
          $pc_served_end = $_POST['pc_served_end'];

          $required = array(
            'pc_name',
            'pc_served_start',
            'pc_served_end'
          );
          foreach ($required as $field) {
            if (empty($_POST[$field])) {
              echo $show->showMessage('danger', 'No field should be left blank!','warning');
              return false;
            }
          }


          $general->addStateExecutives('stateParadeCommanders',array(
            'pc_name' => $pc_name,
             'served_start_date' => $pc_served_start,
             'served_finish_date' => $pc_served_end
           ));
              echo 'success';

      }

if (isset($_POST['action']) && $_POST['action'] == 'fetchDataPC') {

        $data = $general->selectTable('stateParadeCommanders', 0);
        $output = '';

        if ($data) {
          $output .= '<table class="table table-striped table-hover" id="showPC">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Started</th>
                <th>Finised</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>';
            $x = 0;
            $date = date('Y');
            foreach ($data as $presremb) {
              if ($presremb->served_finish_date > $date) {
                $tilNow = '<span class="text-info">To Date</span>';

              }else{
                $tilNow = pretty_dated($presremb->served_finish_date);
              }
              $x = $x + 1;
              $output .= '

                  <tr>
                    <td>'.$x.'</td>

                   <td>'.$presremb->pc_name.'</td>
                     <td>'.pretty_dated($presremb->served_start_date).'</td>
                     <td>'.$tilNow.'</td>

                     <td>

                       <a href="#" id="'.$presremb->id.'" title="Edit Treasure" class="text-success editTreasureIcon" data-toggle="modal" data-target="#editTreasure"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
                     <a href="#" id="'.$presremb->id.'" title="Trash Treasure" class="text-danger trashTreasureIcon"><i class="fas fa-recycle fa-lg"></i> </a>

                     </td>
                    </tr>
                    ';

              }

                      $output .= '
                        </tbody>
                      </table>';
                echo $output;
          }else{
            echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
          }

        }

if (isset($_POST['action']) && $_POST['action'] == 'add_chaState') {

        $cha_name = $show->test_input($_POST['cha_name']);
        $cha_served_start = $_POST['cha_served_start'];
        $cha_served_end = $_POST['cha_served_end'];

        $required = array(
          'cha_name',
          'cha_served_start',
          'cha_served_end'
        );
        foreach ($required as $field) {
          if (empty($_POST[$field])) {
            echo $show->showMessage('danger', 'No field should be left blank!','warning');
            return false;
          }
        }

    $add = $general->addStateExecutives('stateChaplains', 'cha_name', 'served_start_date','served_finish_date',$cha_name,$cha_served_start, $cha_served_end );
        if ($add) {
            echo 'success';
        }
        $general->addStateExecutives('stateChaplains',array(
          'cha_name' => $cha_name,
           'served_start_date' => $cha_served_start,
           'served_finish_date' => $cha_served_end
         ));
            echo 'success';
}

if (isset($_POST['action']) && $_POST['action'] == 'fetchDataCHA') {

    $data = $general->selectTable('stateChaplains', 0);
      $output = '';

      if ($data) {
                $output .= '<table class="table table-striped table-hover" id="showCHA">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Started</th>
                      <th>Finised</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>';
                  $x = 0;
                  $date = date('Y');
                  foreach ($data as $presremb) {
                    if ($presremb->served_finish_date > $date) {
                      $tilNow = '<span class="text-info">To Date</span>';

                    }else{
                      $tilNow = pretty_dated($presremb->served_finish_date);
                    }
                    $x = $x + 1;
                    $output .= '

                        <tr>
                          <td>'.$x.'</td>

                         <td>'.$presremb->cp_name.'</td>
                           <td>'.pretty_dated($presremb->served_start_date).'</td>
                           <td>'.$tilNow.'</td>

                           <td>

                             <a href="#" id="'.$presremb->id.'" title="Edit Treasure" class="text-success editTreasureIcon" data-toggle="modal" data-target="#editTreasure"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
                           <a href="#" id="'.$presremb->id.'" title="Trash Treasure" class="text-danger trashTreasureIcon"><i class="fas fa-recycle fa-lg"></i> </a>

                           </td>
                          </tr>
                          ';

                    }

                            $output .= '
                              </tbody>
                            </table>';
                      echo $output;
                }else{
                  echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
                }

}

if (isset($_POST['action']) && $_POST['action'] == 'add_qbState') {

      $qb_name = $show->test_input($_POST['qb_name']);
      $qb_served_start = $_POST['qb_served_start'];
      $qb_served_end = $_POST['qb_served_end'];


      $required = array(
        'qb_name',
        'qb_served_start',
        'qb_served_end'
      );
      foreach ($required as $field) {
        if (empty($_POST[$field])) {
          echo $show->showMessage('danger', 'No field should be left blank!','warning');
          return false;
        }
      }
      $general->addStateExecutives('stateQBMasters',array(
        'qm_name' => $qm_name,
         'served_start_date' => $qm_served_start,
         'served_finish_date' => $qm_served_end
       ));
          echo 'success';
  }
if (isset($_POST['action']) && $_POST['action'] == 'fetchDataQB') {

  $data = $general->selectTable('stateQBMasters', 0);
  $output = '';

    if ($data) {
    $output .= '<table class="table table-striped table-hover" id="showQB">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Started</th>
        <th>Finised</th>
        <th>Action</th>

      </tr>
    </thead>
    <tbody>';
    $x = 0;
    $date = date('Y');
    foreach ($data as $presremb) {
      if ($presremb->served_finish_date > $date) {
        $tilNow = '<span class="text-info">To Date</span>';

      }else{
        $tilNow = pretty_dated($presremb->served_finish_date);
      }
      $x = $x + 1;
      $output .= '

          <tr>
            <td>'.$x.'</td>

           <td>'.$presremb->qm_name.'</td>
             <td>'.pretty_dated($presremb->served_start_date).'</td>
             <td>'.$tilNow.'</td>

             <td>

               <a href="#" id="'.$presremb->id.'" title="Edit Treasure" class="text-success editTreasureIcon" data-toggle="modal" data-target="#editTreasure"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
             <a href="#" id="'.$presremb->id.'" title="Trash Treasure" class="text-danger trashTreasureIcon"><i class="fas fa-recycle fa-lg"></i> </a>

             </td>
            </tr>
            ';

      }

              $output .= '
                </tbody>
              </table>';
        echo $output;
  }else{
    echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
  }

}

if (isset($_POST['action']) && $_POST['action'] == 'add_bmState') {

      $bm_name = $show->test_input($_POST['bm_name']);
      $bm_served_start = $_POST['bm_served_start'];
      $bm_served_end = $_POST['bm_served_end'];


      $required = array(
        'bm_name',
        'bm_served_start',
        'bm_served_end'
      );
      foreach ($required as $field) {
        if (empty($_POST[$field])) {
          echo $show->showMessage('danger', 'No field should be left blank!','warning');
          return false;
        }
      }

      $general->addStateExecutives('stateBandMasters',array(
        'bm_name' => $bm_name,
         'served_start_date' => $bm_served_start,
         'served_finish_date' => $bm_served_end
       ));
          echo 'success';
}

if (isset($_POST['action']) && $_POST['action'] == 'fetchDataBM') {

  $data = $general->selectTable('stateBandMasters', 0);
  $output = '';

    if ($data) {
    $output .= '<table class="table table-striped table-hover" id="showBM">
      <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Started</th>
        <th>Finised</th>
        <th>Action</th>

      </tr>
    </thead>
    <tbody>';
    $x = 0;
    $date = date('Y');
    foreach ($data as $presremb) {
      if ($presremb->served_finish_date > $date) {
        $tilNow = '<span class="text-info">To Date</span>';

      }else{
        $tilNow = pretty_dated($presremb->served_finish_date);
      }
      $x = $x + 1;
      $output .= '

          <tr>
            <td>'.$x.'</td>

           <td>'.$presremb->bm_name.'</td>
             <td>'.pretty_dated($presremb->served_start_date).'</td>
             <td>'.$tilNow.'</td>

             <td>

               <a href="#" id="'.$presremb->id.'" title="Edit Treasure" class="text-success editTreasureIcon" data-toggle="modal" data-target="#editTreasure"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
             <a href="#" id="'.$presremb->id.'" title="Trash Treasure" class="text-danger trashTreasureIcon"><i class="fas fa-recycle fa-lg"></i> </a>

             </td>
            </tr>
            ';

      }

              $output .= '
                </tbody>
              </table>';
        echo $output;
  }else{
    echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
  }

}

if (isset($_POST['action']) && $_POST['action'] == 'add_pmState') {

      $piom_name = $show->test_input($_POST['piom_name']);

      $required = array(
        'piom_name',
      );
      foreach ($required as $field) {
        if (empty($_POST[$field])) {
          echo $show->showMessage('danger', 'No field should be left blank!','warning');
          return false;
        }
      }
      $general->addPPP('stateBBPionierMem',array(
        'piom_name' => $piom_name
       ));
          echo 'success';
}

if (isset($_POST['action']) && $_POST['action'] == 'fetchDataPM') {

  $data = $general->selectTable('stateBBPionierMem', 0);
  $output = '';

    if ($data) {
    $output .= '<table class="table table-striped table-hover" id="showPM">
      <thead>
        <tr>
        <th>#</th>
        <th>Name</th>
        <th>Action</th>

      </tr>
    </thead>
    <tbody>';
    $x = 0;
    $date = date('Y');
    foreach ($data as $presremb) {

      $x = $x + 1;
      $output .= '

          <tr>
            <td>'.$x.'</td>

           <td>'.$presremb->piom_name.'</td>

             <td>

               <a href="#" id="'.$presremb->id.'" title="Edit Treasure" class="text-success editTreasureIcon" data-toggle="modal" data-target="#editTreasure"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
             <a href="#" id="'.$presremb->id.'" title="Trash Treasure" class="text-danger trashTreasureIcon"><i class="fas fa-recycle fa-lg"></i> </a>

             </td>
            </tr>
            ';

      }

              $output .= '
                </tbody>
              </table>';
        echo $output;
  }else{
    echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
  }

}

if (isset($_POST['action']) && $_POST['action'] == 'add_ppState') {

      $pat_name = $show->test_input($_POST['pat_name']);

      $required = array(
        'pat_name',
      );
      foreach ($required as $field) {
        if (empty($_POST[$field])) {
          echo $show->showMessage('danger', 'No field should be left blank!','warning');
          return false;
        }
      }

       $general->addPPP('stateBBPatrons', array(
        'pat_name' => $pat_name
      ));
      echo 'success';


}

if (isset($_POST['action']) && $_POST['action'] == 'fetchDataPP') {

  $data = $general->selectTable('stateBBPatrons', 0);
  $output = '';

  if ($data) {
  $output .= '<table class="table table-striped table-hover" id="showPP">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Action</th>

      </tr>
    </thead>
    <tbody>';
    $x = 0;
    $date = date('Y');
    foreach ($data as $presremb) {

      $x = $x + 1;
      $output .= '

          <tr>
            <td>'.$x.'</td>

           <td>'.$presremb->pat_name.'</td>

             <td>

               <a href="#" id="'.$presremb->id.'" title="Edit Treasure" class="text-success editTreasureIcon" data-toggle="modal" data-target="#editTreasure"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
             <a href="#" id="'.$presremb->id.'" title="Trash Treasure" class="text-danger trashTreasureIcon"><i class="fas fa-recycle fa-lg"></i> </a>

             </td>
            </tr>
            ';

      }

              $output .= '
                </tbody>
              </table>';
        echo $output;
  }else{
    echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
  }

}
