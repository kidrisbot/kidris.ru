 <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">МЕНЮ</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="/starter"><i class="fa fa-dashboard"></i> <span>Главная</span></a></li>
<li class=" {activeForDash} treeview">
              <a href="#"><i class="fa fa-edit"></i> <span>Настройки</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu" style="display: {blockfordash};">
              {spisoktpl}
              </ul>
            </li>
            <li class=" {activeForStart} treeview">
              <a href="#"><i class="fa fa-table"></i> <span>Статистика</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu" style="display: {blockforstats};">
            {spisoktplstatii}
           
            </ul>
            </li>
            <li class=" {activeForGrafs} treeview">
              <a href="#"><i class="fa fa-pie-chart"></i> <span>Графики</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu" style="display: {blockforgraf};">
             {spisoktplstatss}
             </ul>
            </li>
            <li><a href="http://biklus.ru/"><i class="fa fa-link"></i> <span>Biklus</span></a></li>
            
          </ul><!-- /.sidebar-menu -->
