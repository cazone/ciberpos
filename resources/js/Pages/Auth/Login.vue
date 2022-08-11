<template>
     <!-- main body area -->
    <div class="main auth-div p-2 py-3 p-xl-5">

        <!-- Body: Body -->
        <div class="body d-flex p-0 p-xl-5">
            <div class="container-fluid">

                <div class="row g-0">
                    <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                        <div style="max-width: 25rem;">
                            <div class="text-center mb-5">
                                <img src="images/logo.png" alt="logo" class="img-fluid">
                            </div>


                            <!-- List Checked -->



                        </div>
                    </div>

                    <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        <div class="w-100 p-4 p-md-5 card border-0" style="max-width: 32rem;">
                            <!-- Form -->
                            <form  @submit.prevent="submit" class="row g-1 p-0 p-md-4">
                                <div class="col-12 text-center mb-5">
                                    <h1>Iniciar sesi&oacute;n</h1>
                                    <span>Ingrese sus datos para iniciar sesi&oacute;n en su cuenta: </span>
                                </div>
                                <jet-validation-errors class="mb-3" />
                                  <div v-if="status" class="alert alert-success mb-3 rounded-0" role="alert">
                                     {{ status }}
                                   </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <jet-label for="email" value="Email" />
                                        <jet-input id="email" type="email" v-model="form.email" required autofocus />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-2">
                                        <div class="form-label">
                                            <span class="d-flex justify-content-between align-items-center">
                                                Password
                                                <!-- <Link v-if="canResetPassword" :href="route('password.request')" class="text-muted me-3">
                                                <a class="text-primary" href="auth-password-reset.html">¿Has olvidado tu contraseña?</a> -->
                                                <!-- </Link> -->
                                            </span>
                                        </div>

                                     <jet-input id="password" type="password" v-model="form.password" required autocomplete="current-password" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                       <jet-checkbox id="remember_me" name="remember" v-model:checked="form.remember" />
                                        <label class="custom-control-label" for="remember_me">
                                          Recu&eacute;rdame
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4">
                                  <jet-button class="ms-4" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                                      <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden">Catgando...</span>
                                      </div>

                                      Entrar
                                </jet-button>
                                </div>

                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div> <!-- End Row -->

            </div>
        </div>

    </div>


</template>

<script>
import { defineComponent } from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
  },

  props: {
    canResetPassword: Boolean,
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false
      })
    }
  },

  methods: {
    submit() {
      this.form
          .transform(data => ({
            ... data,
            remember: this.form.remember ? 'on' : ''
          }))
          .post(this.route('login'), {
            onFinish: () => this.form.reset('password'),
          })
    }
  }
})
</script>
