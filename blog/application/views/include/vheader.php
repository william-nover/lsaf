<?php 
$ci =& get_instance();
$ci->load->model('web/Model_content');
$ListSosmed =array();
$ListLoc =array();
$sosmed=121;
$string =$sosmed;
$arrayin=array_map('intval', explode(',', $string));
$where_in = implode(",",$arrayin);
$order_sosmed='';
$order_sosmed .= " order by a.row_order ASC";
$order_sosmed .= " limit  0, 8";
$whereSosmed = '';
$whereSosmed .= " WHERE a.row_active_status=1 and a.row_active_status=1 and a.row_parent=0 and a.module_id in(".$where_in.") ";            
$ListSosmedAll = $ci->Model_content->getListContent($whereSosmed,$order_sosmed);        
foreach ($ListSosmedAll as $lc){
if ($lc['module_id']== $sosmed){
$ListSosmed[]=$lc; 
$countSosmed = count($ListSosmed);
} 
}
?>
<header>
  <!-- start navigation -->
  <nav class="navbar navbar-default bootsnav background-white navbar-expand-lg">
    <div class="container nav-header-container">
      <!-- start logo -->
      <div class="col-auto pl-0">
        <a href="https://lsafglobal.com/" target="_blank" title="logo" class="logo">
          <img src="<?=IMAGES_BASE_URL;?>/logo-color.png" data-rjs="<?=IMAGES_BASE_URL;?>/logo-color.png" class="logo-light default" alt="logo">
        </a>
      </div>
      <!-- end logo -->
      <div class="col accordion-menu pr-0 pr-md-3">
        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar-collapse-toggle-1">
          <span class="sr-only">toggle navigation
          </span>
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
        </button>
        <div class="navbar-collapse collapse justify-content-end" id="navbar-collapse-toggle-1">
          <ul id="accordion" class="nav navbar-nav navbar-left no-margin alt-font text-normal" data-in="fadeIn" data-out="fadeOut">
            <li class="dropdown simple-dropdown">
              <a href="#">About LSAF
              </a>
              <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true">
              </i>
              <!-- start sub menu -->
              <ul class="dropdown-menu animated fadeOut" role="menu">
                <li>
                  <a href='https://lsafglobal.com/Aboutlsaf/3/19/Mission, Vision, Core Values and Culture'>Mission, Vision, Core Values and Culture
                  </a> 
                </li>            
                <li>
                  <a href='https://lsafglobal.com/Aboutlsaf/3/53/Board of Industry Advisors and Partners'>Board of Industry Advisors and Partners
                  </a> 
                </li>            
                <li>
                  <a href='https://lsafglobal.com/Aboutlsaf/3/20/Message from Chief Executive Officer'>Message from Chief Executive Officer
                  </a> 
                </li>            
                <li>
                  <a href='https://lsafglobal.com/Aboutlsaf/3/80/MessagefromDeanatLSAFJakartaCampus'>Message from Dean at LSAF Jakarta Campus
                  </a> 
                </li>            
                <li>
                  <a href='https://lsafglobal.com/Aboutlsaf/3/79/MessagefromDeanatLSAFKabulCampus'>Message from Dean at LSAF Kabul Campus
                  </a> 
                </li>            
                <li>
                  <a href='https://lsafglobal.com/Aboutlsaf/3/21/Academic Board'>Academic Board
                  </a> 
                </li>            
                <li>
                  <a href='https://lsafglobal.com/Aboutlsaf/3/81/GlobalConsulting'>Global Consulting
                  </a> 
                </li>    
              </ul>
            </li>
            <li class="dropdown simple-dropdown">
              <a href="#">Discover ACCA
              </a>
              <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true">
              </i>
              <!-- start sub menu -->
              <ul class="dropdown-menu animated fadeOut" role="menu">
                <li>
                  <a href='https://lsafglobal.com/Discover_acca/5/54/What is ACCA?'>What is ACCA?
                  </a> 
                </li>            
                <li>
                  <a href='https://lsafglobal.com/Discover_acca/5/25/Why choose to study ACCA'>Why Choose To Study ACCA?
                  </a> 
                </li>            
                <li>
                  <a href='https://lsafglobal.com/Discover_acca/5/26/ACCA Qualification Student Journey'>ACCA Qualification Student Journey
                  </a> 
                </li>            
                <li>
                  <a href='https://lsafglobal.com/Discover_acca/5/55/ACCA member salaries'>ACCA Member Salaries
                  </a> 
                </li>            
                <li>
                  <a href='https://lsafglobal.com/Discover_acca/5/27/ACCA Complete Finance Professional Framework'>ACCA Complete Finance Professional Framework
                  </a> 
                </li>            
                <li>
                  <a href='https://lsafglobal.com/Discover_acca/5/29/Studying and working internationally'>Studying and Working Internationally
                  </a> 
                </li> 
              </ul>
            </li>
            <li class="dropdown simple-dropdown"><a href="#">Courses</a><i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
	<!-- start sub menu -->
	<ul class="dropdown-menu animated fadeOut" role="menu">
	 <li>
        <a href='https://lsafglobal.com/Courses/6/62/LSAF Short Courses and Workshops'>LSAF Short Courses and Workshops
        </a> 
      </li>            
      <li>
        <a href='https://www.lsafglobal.com/Courses/6/78/IGCSEandALevelPrep'>IGCSE and A Level Prep
        </a> 
      </li>
	<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="https://lsafglobal.com/Courses/6/30/Profesional Certificate">Professional Certificates <i class="fas fa-angle-right"></i></a>
		<ul class="dropdown-menu animated">
          <li>
            <a href='https://lsafglobal.com/Courses/6/30/68/Introductory in Financial &amp; Management Accounting'>Introductory in Financial &amp; Management Accounting
            </a>
          </li>
          <li>
            <a href='https://lsafglobal.com/Courses/6/30/69/IntermediateCertificateinFinancial&ampManagementAccounting'>Intermediate Certificate in Financial &amp; Management Accounting
            </a>
          </li>
          <li>
            <a href='https://lsafglobal.com/Courses/6/30/72/FoundationsCertificateinAudit'>Foundations Certificate in Audit
            </a>
          </li>
          <li>
            <a href='https://lsafglobal.com/Courses/6/30/73/FoundationsCertificateinFinancialManagement'>Foundations Certificate in Financial Management
            </a>
          </li>
        </ul>
      </li>  
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href='https://lsafglobal.com/Courses/6/35/Profesional Diplomas'>Professional Diplomas<i class="fas fa-angle-right"></i></a>
		<ul class="dropdown-menu animated">
          <li>
            <a href='https://lsafglobal.com/Courses/6/35/70/DiplomainAccountingandBusiness'>Diploma in Accounting and Business
            </a>
          </li>
          <li>
            <a href='https://lsafglobal.com/Courses/6/35/71/AdvancedDiplomainAccountingandBusiness'>Advanced Diploma in Accounting and Business
            </a>
          </li>
        </ul>
      </li> 
	  <li>
        <a href='https://lsafglobal.com/Courses/6/63/ACCA Qualifications'>ACCA Qualifications
        </a> 
      </li>            
      <li>
        <a href='https://lsafglobal.com/Courses/6/64/ACCABScOxfordBrookesUniversityOBU'>ACCA/ BSc Oxford Brookes University (OBU)
        </a> 
      </li>            
      <li>
        <a href='https://lsafglobal.com/Courses/6/65/ACCA-MSc University of London-UOL'>ACCA/ MSc University of London (UOL)
        </a> 
      </li> 
	  
	</ul>
</li>
  <li class="dropdown simple-dropdown"><a href="#">Students</a><i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
	<!-- start sub menu -->
	<ul class="dropdown-menu animated fadeOut" role="menu">
	 <li>
        <a href='https://lsafglobal.com/Students/7/74/JuniorHighSchoolGraduatesGrade10'>Junior High School Graduates (Grade 10)
        </a> 
      </li>            
      <li>
        <a href='http://lsafglobal.com/Students/7/75/SeniorHighSchoolGraduatesGrade10-12'>Senior High School Graduates (Grade 10 - 12)
        </a> 
      </li>            
      <li>
        <a href='https://lsafglobal.com/Students/7/76/UniversityGraduatesandWorkingAdults'>University Graduates and Working Adults
        </a> 
      </li>            
      <li>
        <a href='https://lsafglobal.com/Students/7/77/Enterpreneurs'>Enterpreneurs
        </a> 
      </li> 
	  
	</ul>
</li>          
            
            <li class="">
              <a href='https://www.lsafglobal.com/Location'>Contact Us </a>
            </li>    
    <li class="">
              <a href="<?=BASE_URL;?>/blog.html" title="Blog">Blog
              </a>
            </li>
            
          </ul>
        </div>
      </div>
      <div class="col-auto pr-lg-0">
        <div class="header-social-icon d-none d-md-inline-block">
          <?php if($countSosmed > 0){
$i=0;
foreach($ListSosmed as $loc){  $i++;  
?>
          <a title="facebook" href="<?= html_entity_decode(contentValue($loc, 'fb'));?>/" target="_blank">
            <i class="fab fa-facebook-f" aria-hidden="true">
            </i>
          </a>
          <a title="twitter" href="<?= html_entity_decode(contentValue($loc, 'tw'));?>" target="_blank">
            <i class="fab fa-twitter">
            </i>
          </a>
          <a title="lk" href="<?= html_entity_decode(contentValue($loc, 'lk'));?>" target="_blank">
            <i class="fab fa-linkedin">
            </i>
          </a>
          <a title="youtube" href="<?= html_entity_decode(contentValue($loc, 'yt'));?>" target="_blank">
            <i class="fab fa-youtube no-margin-right" aria-hidden="true">
            </i>
          </a>
          <?php }}?>  
        </div>
      </div>
    </div>
  </nav>
  <!-- end navigation --> 
</header>
