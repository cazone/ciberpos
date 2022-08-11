<template>
   <Head :title="title" />
  <div id="layout-d" class="theme-blue">

    <!-- Navigation -->
    <div class="header fixed-top px-lg-5 px-md-2 shadow-sm">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">

                <!-- Brand -->
                <Link :href="route('dashboard')">
                <a  class="me-3 me-lg-4 brand-icon">
                    <img :src=" url + '/images/logo-mini.png'" alt="logo"   style="width: 50px; height: 50px">
                </a>
                </Link>

                <!-- header rightbar icon -->
                <div class="h-right d-flex align-items-center me-5 me-lg-0 order-1">

                    <div class="dropdown user-profile ms-2 ms-sm-3">
                        <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown">
                            <img class="avatar rounded-circle img-thumbnail" :src="$page.props.user.profile_photo_url" alt="">
                        </a>
                        <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                            <div class="card border-0 w240">
                                <div class="card-body border-bottom">
                                    <div class="d-flex py-1">
                                        <img class="avatar rounded-circle" :src="$page.props.user.profile_photo_url" alt="">
                                        <div class="flex-fill ms-3">
                                            <p class="mb-0 text-muted"><span class="fw-bold"> {{ $page.props.user.name }}</span></p>
                                            <small class="text-muted"> {{ $page.props.user.email }}</small>
                                            <form @submit.prevent="logout">
                                                <jet-dropdown-link as="button">
                                                  Cerra sesión
                                                </jet-dropdown-link>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group m-2">
                                    <Link :href="route('profile.show')" >
                                        <a  class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-cog"></i>Tu perfil</a>
                                     </Link>

                                    <!-- <a href="#" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-tag"></i>Customization</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-users"></i>Manage team</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-calendar"></i>My Events</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-credit-card"></i>My Statements</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- menu toggler -->
                <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                    <span class="fa fa-bars"></span>
                </button>

                <!-- main menu -->
                <div class="collapse navbar-collapse order-0" id="mainHeader">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                        <Link :href="route('dashboard')">
                         <a class="nav-link active"><i class="fa fa-dashboard me-2"></i><span>Dashboard</span></a>
                        </Link>

                        </li>
                        <li v-if="role == 'Admin'" class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-users me-2"></i><span>Clientes</span>
                            </a>
                            <ul class="dropdown-menu rounded-lg shadow border-0 dropdown-animation">
                                 <Link :href="route('client.index')" >
                                    <li><a class="dropdown-item" href="#">Listado</a></li>
                                </Link>
                                 <Link :href="route('client.create')" >
                                    <li><a class="dropdown-item" href="#">Nuevo</a></li>
                                </Link>

                            </ul>
                        </li>





                    </ul>
                </div>

            </div>
        </nav>

        <!-- Search: div -->

    </div>

    <!-- main body area -->
    <div class="main px-lg-5 px-md-2">

        <!-- Body: Header -->
        <div class="body-header border-bottom d-flex py-lg-3 py-md-2">
            <slot name="header"></slot>
            <!-- <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <small class="text-muted">Welcome back</small>
                        <h1 class="h4 mt-1">Dashboard</h1>
                    </div>
                    <div class="col-auto">
                        <a href="https://themeforest.net/user/wrraptheme" title="Download" target="_blank" class="btn btn-white border lift">Download</a>
                        <button type="button" class="btn btn-dark lift">Generate Report</button>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- Body: Body -->
        <div class="body d-flex py-lg-4 py-3">
            <div class="container-fluid">

               <slot></slot>

            </div>
        </div>

        <!-- Body: Footer -->
        <div class="body-footer d-flex">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="card mb-3 border-0">
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <p class="font-size-sm mb-0">Desarrollo de <span class="d-none d-sm-inline-block"><a class="list-separator-link"  href="https://scredes.com.mx/"  target="_blank">SC REDES</a> </span></p>
                                </div>
                                <div class="col-auto">
                                    <div class="d-flex justify-content-end">
                                        <!-- List Dot -->
                                        <!-- <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a class="list-separator-link" @click="dialogAcerca = true" href="#">Acerca de</a>
                                            </li>

                                        </ul> -->
                                        <!-- End List Dot -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</div>
<el-dialog v-model="dialogAcerca" title="Acerca de">
<p>Este es un desarrollo creado por SC REDES en colaboracion con EMPRESA</p>
<p>contacto@scredes.com.mx</p>
  </el-dialog>
</template>

<script>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import JetBanner from '@/Jetstream/Banner.vue'
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
import JetDropdown from '@/Jetstream/Dropdown.vue'
import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
import JetNavLink from '@/Jetstream/NavLink.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'

export default {
  props: {
    title: String,

  },
  components: {
    Head,
    JetApplicationLogo,
    JetBanner,
    JetApplicationMark,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    Link,
  },

  data() {
    return {
        dialogAcerca: false,
      showingNavigationDropdown: false,
        url: null,
    }
  },
  mounted() {
       this.url = process.env.MIX_APP_URL;

  },

  methods: {
    switchToTeam(team) {
      this.$inertia.put(route('current-team.update'), {
        'team_id': team.id
      }, {
        preserveState: false
      })
    },

    logout() {
      this.$inertia.post(route('logout'));
    },
  },

  computed: {
    path() {
      return window.location.pathname
    },
    role() {
      return this.$page.props.auth.role[0]
    }
  }
}
</script>
