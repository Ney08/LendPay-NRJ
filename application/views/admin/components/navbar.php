<nav class="navbar navbar-expand bg-danger topbar mb-4 static-top shadow alig">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3  btn-white ">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Search -->
  <!-- <form class="d-none d-sm-inline-block form-inline mw-100 navbar-search">
    <div class="input-group">
      <input type="text" class="form-control bg-light border-0 small" placeholder="Search..." aria-label="Search"
        aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-dark" type="button">
          <i class="fas fa-search fa-sm"></i>
        </button>
      </div>
    </div>
  </form> -->

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none ">
      <!-- <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
      </a> -->
      <!-- Dropdown - Messages -->
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
              aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-light" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>
    
    
    
    <style>
      #sidebarToggleTop {
        color: #f8f9fa;
        /* Light color */
      }

      #searchDropdown {
        color: #f8f9fa;
        /* Light color */
      }

      .fas.fa-bell {
        color: #f8f9fa;
        /* Light color */
      }
      /* .navbar-search{
        margin-left: 35% !important;
      } */
      
    </style>

    
    <!-- Nav Item - Alerts -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle alert_loan" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <?php
        //public function
        // Initialize the notification count
         $notificationCount = 0;
        // // Display the badge only if there are notifications
        // if ($notificationCount > 0) {
        //   echo '<span class="badge badge-danger badge-counter">' . $notificationCount . '+</span>';
        // }
       
      echo '</a>
      <!-- Dropdown - Alerts -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
          Centro de Notificación
        </h6>';
        

        //<!-- get automacly alert from db clients -->

        
        
        // Get the current date
        $currentDate = date("Y-m-d");
        //$currentDate1 = date("Y-m-d", strtotime
        // ($currentDate));
        // // Add a daily notification if the current date is the 15th of the month
        // if (date('d') == 15) {
        //   echo '<a class="dropdown-item d-flex align-items-center" href="#">
        //   <div class="mr-3">
        //     <div class="icon-circle bg-light">
        //       <i class="fas fa-calendar-day text-white"></i>
        //     </div>
        //   </div>
        //   <div>
        //     <div class="small text-gray-500">' . $currentDate . '</div>
        //     <span class="font-weight-bold">Hoy es 15 del mes. Recuerda revisar los pagos pendientes!</span>
        //   </div>
        //   </a>';
        // }
        
        // get date from tables loan_items
        $this->db->select("li.id, c.dni, li.date, l.client_id, concat(c.first_name,' ',c.last_name) AS name_cst, l.id AS loan_id, li.pay_date, li.num_quota, li.fee_amount");
        $this->db->from('loan_items li');
        $this->db->join('loans l', 'l.id = li.loan_id', 'left');
        $this->db->join('clients c', 'c.id = l.client_id', 'left');
        $this->db->where('li.status', 1);
        $this->db->order_by('li.pay_date', 'desc');
        $query = $this->db->get();

        
        foreach ($query->result() as $row) {
          $date = $row->date;
          $name = $row ->name_cst;
          $fee = $row->fee_amount;
          
          if ($date == $currentDate) {
            global $notificationCount;
            $notificationCount++;
            echo '<a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-light">
                <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500" >Recordatorio</div>
              <span class="font-weight-bold">El cliente ' . $name .' tiene un saldo pendiente de '. $fee . ' DOP para pagar hoy ' . $currentDate . '</span>
            </div>
            </a>';
          } 
        } 
        if ($notificationCount > 0) {
          echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
              const alertLink = document.querySelector("#alertsDropdown");
              if (alertLink) {
                alertLink.innerHTML += `<span class="badge badge-danger badge-counter">' . $notificationCount . '+</span>`;
              }
            });
          </script>';
        }
  
        // Add a monthly notification if the current date is the last day of the month
        // if (date('Y-m-d') == date('Y-m-t')) { // 'Y-m-t' gives the last day of the current month
        //   echo '<a class="dropdown-item d-flex align-items-center" href="#">
        //   <div class="mr-3">
        //     <div class="icon-circle bg-light">
        //       <i class="fas fa-calendar-check text-white"></i>
        //     </div>
        //   </div>
        //   <div>
        //     <div class="small text-gray-500">' . $currentDate . '</div>
        //     <span class="font-weight-bold">Hoy es el último día del mes. Recuerda revisar los cobros!</span>
        //   </div>
        //   </a>';
        // }

        // Check if any client has a payment due today
        
        
        // function renderClientPaymentNotifications($db, $currentDate) {
        //     $db->select("clients.first_name, clients.last_name, loans_items.fee_amount");
        //     $db->from("loans_items");
        //     $db->join("loans", "loans.id = loans_items.loan_id", "left");
        //     $db->join("clients", "clients.id = loans.client_id", "left");
        //     $db->where("loans_items.date", $currentDate);
        //     $db->where("loans_items.status", 1); // Assuming 1 means payment is due
        //     $query = $db->get();
        
        //     if ($query->num_rows() > 0) {
        //         foreach ($query->result_array() as $row) {
        //             echo "<a class='dropdown-item d-flex align-items-center' href='#'>
        //             <div class='mr-3'>
        //               <div class='icon-circle bg-light'>
        //                 <i class='fas fa-calendar-check text-white'></i>
        //               </div>
        //             </div>
        //             <div>
        //               <div class='small text-gray-500'>{$currentDate}</div>
        //               <span class='font-weight-bold'>El cliente {$row['first_name']} {$row['last_name']} tiene un pago pendiente de \${$row['fee_amount']} hoy.</span>
        //             </div>
        //             </a>";
        //         }
        //     }
        // }
        
        // // Call the function
        // renderClientPaymentNotifications($this->db, $currentDate);
       

        // Add a weekly notification if the current date is monday
  
        // Add a weekly notification if the current date is Monday
        // if (date('N') == 1) { // 'N' gives the day of the week (1 for Monday, 7 for Sunday)
        //   echo '<span class="badge badge-danger badge-counter">4+</span>';
        //   echo '<a class="dropdown-item d-flex align-items-center" href="#">
        //   <div class="mr-3">
        //     <div class="icon-circle bg-light">
        //     <i class="fas fa-calendar-week text-white"></i>
        //     </div>
        //   </div>
        //   <div>
        //     <div class="small text-gray-500">' . $currentDate . '</div>
        //     <span class="font-weight-bold">Recuerda revisar los clientes que faltan por pagar esta semana!</span>
        //   </div>
        //   </a>';
        // }

        // Add a day by day notification 
        // if (date('Y-m-d') == date('Y-m-d')) { // 'Y-m-t' gives the last day of the current month
         
        //   echo '<a class="dropdown-item d-flex align-items-center" href="#">
        //   <div class="mr-3">
        //     <div class="icon-circle bg-light">
        //       <i class="fas fa-calendar-day text-white"></i>
        //     </div>
        //   </div>
        //   <div>
        //     <div class="small text-gray-500">' . $currentDate . '</div>
        //     <span class="font-weight-bold">Hoy es ' . $currentDate . ' Recuerda revisar los pagos pendientes!</span>
        //   </div>
        //   </a>';
        // }
        // make a fuction to get the notifications from the db
        


        
          
           
        
        ?>



        <a class="dropdown-item text-center small text-gray-500" href="#"></a>
      </div>
    </li>
    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span
          class="mr-2 d-none d-lg-inline text-white small"><?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?></span>
        
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="white" class="bi bi-person-circle img-profile rounded-circle " viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
</svg>
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo site_url('user/logout'); ?>">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Salir
        </a>
      </div>
    </li>
        
  </ul>

</nav>