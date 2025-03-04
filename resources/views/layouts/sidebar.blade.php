   <!--begin::Sidebar-->
   <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="welcome" class="brand-link  ">
            <!--begin::Brand Image-->
            <img
              src="/image/logo3.jpg"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow  rounded-full"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Toché le Bénin</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
             <!-- début des tableaux -->
             

             <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-table text-primary : Bleu"></i>
                  <p>
                    Les tableaux
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('contact.liste') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Tableau des Contacts</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('indexcategorie') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Tableaux des Catégoies</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('indexreservations') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Tableau Reservations</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('indexvisites') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Tableau des Visites</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('indexevenements') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Tableaux des Evenements</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('stores') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Tableau des Galeries</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('indexroles') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Tableau des Roles</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('indextickets') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Tableau des Tickets</p>
                    </a>
                  </li>
                </ul>
              </li>
                        <!-- Début des formulaire -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-pencil-square text-success"></i>
                  <p>
                    Les Formulaires
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('formulaire') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>formulaire</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('createcategorie') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter une Carégorie</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('create') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter un Sites</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('evenement.create') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter une Evenements</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('reservations') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter une Reservations</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('visites') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter une Visites</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('tickets') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter une Tickets</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('roles') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter une Roles</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- fin des formulaire -->

             
            <!-- LES sites touristiques -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-tree-fill text-danger"></i>
                  <p>
                   Sites touristiques
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('create') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Creer un Site</p>
                    </a>
                  
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-success"></i>
                      <p class="text-indigo-500">Tableaux des sites</p>
                    </a>
                  
                  </li>
                </ul>
              </li>
                <!--  fin des sites touristiques -->

                <!-- Reservation -->
                <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-tree-fill text-danger"></i>
                  <p>
                    Reservation
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('reservations') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter une Reservations</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('indexreservations') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-success"></i>
                      <p>Tableau Reservations</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- fin reservation -->
                <!-- Visites -->
                <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-tree-fill text-danger"></i>
                  <p>
                  Visites
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('visites') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter une Visites</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('indexvisites') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-success"></i>
                      <p>Tableau des Visites</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- fin Visites -->
                <!-- Evenements -->
                <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-tree-fill text-danger"></i>
                  <p>
                  Evenements
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('evenement.create') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter un Evenements</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('indexevenements') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-success"></i>
                      <p>Tableaux des Evenements</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- fin Evenements -->
                <!-- Galeries -->
                <li class="nav-item">
                <a href="#" class="nav-link"> 
                  <i class="nav-icon bi bi-tree-fill text-danger"></i>
                  <p>
                  Galeries
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('stores') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-success"></i>
                      <p>Tableau des Galeries</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- fin Galeries -->
                <!-- Roles -->
                <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-tree-fill text-danger"></i>
                  <p>
                  Roles
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('roles') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter une Roles</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('indexroles') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-success"></i>
                      <p>Tableau des Roles</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- fin Roles -->
                 <!-- Tickets -->
                 <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-tree-fill text-danger"></i>
                  <p>
                      Tickets
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a  href="{{ route('tickets') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-warning"></i>
                      <p>Ajouter une Tickets</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('indextickets') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle text-success"></i>
                      <p>Tableau des Tickets</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- fin Tickets -->
                
              <!-- fin Utilisateurs -->

              <!-- les pages d'authentifications -->
              <li class="nav-header">les Authentification</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-arrow-in-right"></i>
                  <p>
                    Authentification
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-box-arrow-in-right"></i>
                      <p>
                        Version 1
                        <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="./examples/login.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Login</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="./examples/register.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Register</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
           <!-- fin d'authentification -->
          
              <li class="nav-item">
                <a href="./docs/faq.html" class="nav-link">
                  <i class="nav-icon bi bi-question-circle-fill"></i>
                  <p>FAQ</p>
                </a>
              </li>
              <li class="nav-header">Abonnements à Newsletter</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>
                    Level 1
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
              </li>
              
              <li class="nav-header">LABELS</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-circle text-danger"></i>
                  <p class="text">Important</p>
                </a>
              </li>
            
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->