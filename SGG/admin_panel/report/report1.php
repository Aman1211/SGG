   <?php
            require_once('repotico/reportico.php'); 
            $q = new reportico();
            $q->initial_project_password = ""; // If required
            $q->initial_sql = "SELECT Area_name AS AREA NAME FROM area";
            $q->initial_output_format = "HTML";
            $q->access_mode = "REPORTOUTPUT";
            $q->embedded_report = true;
            $q->execute();
          ?> 