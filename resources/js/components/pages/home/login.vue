<script setup>
import { reactive, ref } from "vue";
import router from "./../../../router/index.js";

let form = reactive({
    email: "",
    password: "",
});



const login = async () => {
    await axios.post("api/login", form).then((response) => {
        if (response.data.success) {
            localStorage.setItem("token", response.data.data.token);
            router.push("/");
             toast.fire({
            icon: "success",
            title: "Connect  Successfully",
        });
        } else {
           toast.fire({
            icon: "error",
            title: response.data.message,
        });
        }
    });
};
</script>

<template>
    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <section
            class="p-0 d-flex align-items-center position-relative overflow-hidden"
        >
            <div class="container-fluid">
                <div class="row">
                    <!-- left -->
                    <div
                        class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100"
                    >
                        <div class="p-3 p-lg-5">
                            <!-- Title -->
                            <div class="text-center">
                                <h2 class="fw-bold">
                                    Bienvenue dans notre plus grande communauté
                                </h2>
                                <p class="mb-0 h6 fw-light">
                                    Apprenons quelque chose de nouveau aujourd'hui!
                                </p>
                            </div>
                            <!-- SVG Image -->
                            <img
                                src="assets/images/element/02.svg"
                                class="mt-5"
                                alt=""
                            />
                        </div>
                    </div>

                    <!-- Right -->
                    <div class="col-12 col-lg-6 m-auto">
                        <div class="row my-5">
                            <div class="col-sm-10 col-xl-8 m-auto">
                                <!-- Title -->
                                <span class="mb-0 fs-1">👋</span>
                                <h1 class="fs-2">Connectez-vous à EduqMe!</h1>
                                <p class="lead mb-4">
                                    Ravi de vous voir ! Veuillez vous connecter avec votre compte.
                                </p>

                                <!-- Form START -->
                                <form @submit.prevent="login()">
                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label
                                            for="exampleInputEmail1"
                                            class="form-label"
                                            >Email address *</label
                                        >
                                        <div class="input-group input-group-lg">
                                            <span
                                                class="input-group-text bg-light rounded-start border-0 text-secondary px-3"
                                                ><i
                                                    class="bi bi-envelope-fill"
                                                ></i
                                            ></span>
                                            <input
                                                type="email"
                                                class="form-control border-0 bg-light rounded-end ps-1"
                                                placeholder="E-mail"
                                                v-model="form.email"
                                                id="exampleInputEmail1"
                                            />
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label
                                            for="inputPassword5"
                                            class="form-label"
                                            >Password *</label
                                        >
                                        <div class="input-group input-group-lg">
                                            <span
                                                class="input-group-text bg-light rounded-start border-0 text-secondary px-3"
                                                ><i class="fas fa-lock"></i
                                            ></span>
                                            <input
                                                type="password"
                                                class="form-control border-0 bg-light rounded-end ps-1"
                                                placeholder="password"
                                                v-model="form.password"
                                                id="inputPassword5"
                                            />
                                        </div>
                                        <div
                                            id="passwordHelpBlock"
                                            class="form-text"
                                        >
                                            Votre mot de passe doit comporter au moins 8 caractères.
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="align-items-center mt-0">
                                        <div class="d-grid">
                                            <button
                                                class="btn btn-primary mb-0"
                                                type="submit"
                                            >
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Form END -->

                                <!-- Sign up link -->
                                <div class="mt-4 text-center">
                                    <span
                                        >Vous n'avez pas de compte?
                                        <router-link to="/register"
                                            >Inscrivez-vous ici</router-link
                                        ></span
                                    >
                                </div>
                            </div>
                        </div>
                        <!-- Row END -->
                    </div>
                </div>
                <!-- Row END -->
            </div>
        </section>
    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <!-- Back to top -->
    <div class="back-top">
        <i
            class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"
        ></i>
    </div>
</template>
