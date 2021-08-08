 <?php 
                 if ($borrowedBook){
                 
              <?php if ($borrowedBook->retured == 0): ?>
               <?php
                  $Currentdate = date("d");
                  $fulldate = date("Y m, d");

                  $retureDate = pretty_day($borrowedBook->toBeRetured_Date);
                if (($retureDate != $Currentdate)): ?>
                <p class="text-danger">You are to return your borrowed book on or before <i class="fa fa-arrow-down fa-lg"></i></p><hr>
                <div id="DateCountdown" data-date="<?=$borrowedBook->toBeRetured_Date?>" style="width: auto; height: auto; padding: 0px; box-sizing: border-box; background-color: inherit;"></div>
               <?php else: ?>
                <center>
                 <span class="text-center text-danger text-lg">You are suppose to return this book before today runs out! failure to do so you will face punishment!</span><hr>
             <?php
             date_default_timezone_set('Africa/Lagos');
             $Currentdate = date("d");
             $returnTime = pretty_datee($borrowedBook->time_before_log);
             $time = pretty_time(date("Y:m d, h:i A"));

             $retureDate = pretty_day($borrowedBook->toBeRetured_Date);
           if (($retureDate == $Currentdate)) {
             $studentOffended = new Student();
             $student = new User();
              $studentId = $student->data()->id;
              if ($time > $returnTime) {
                $studentOffended->sendToLog($studentId);
                $studentOffended->updateOffended($studentId);
                //update borrowed set time to empty
                  $studentOffended->updateTimeInBorrowed($studentId);
              }

                }
               ?>


               </center>
              <?php endif ?>

               <?php endif ?>
               <?php else: ?>
                 <span class="py-2 text-info text-lg">Timer starts when book is approved</span>
              <?php endif ?>
                 }
                 ?>