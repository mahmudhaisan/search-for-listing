<?php
 

 // show available star ratings
 if ($averageRating == 1 && $averageRating <= 1.20) {
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
 }
 if ($averageRating > 1.20 && $averageRating < 1.75) {
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fas fa-star-half-alt checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
 }
 if ($averageRating >= 1.75 && $averageRating <= 2.20) {
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
 }
 if ($averageRating > 2.20 && $averageRating < 2.75) {
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fas fa-star-half-alt checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
 }
 if ($averageRating >= 2.75 && $averageRating <= 3.20) {
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
 }
 if ($averageRating > 3.20 && $averageRating < 3.75) {
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fas fa-star-half-alt checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
 } elseif ($averageRating >= 3.75 && $averageRating <= 4.20) {
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star not-checked"></span>';
 }
 if ($averageRating > 4.20 && $averageRating < 4.75) {
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fas fa-star-half-alt checked"></span>';
 }
 if ($averageRating >= 4.75 && $averageRating <= 5) {
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
     echo '<span class="fa fa-star checked"></span>';
 }
