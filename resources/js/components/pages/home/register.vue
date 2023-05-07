<script setup>
import { reactive, ref, onMounted } from "vue";
import router from "./../../../router/index.js";

const levels = ref({});

let form = reactive({
    name: "",
    sex: "",
    level_id: "",
    email: "",
    password: "",
    c_password: "",
});

let errors = ref([]);

const getLevels = async () => {
    let response = await axios("/api/get_levels");
    levels.value = response.data.levels;
    console.log("levels", response.data.levels);
};

const register = async () => {
    await axios.post("/api/register", form).then((response) => {
        if (response.data.success) {
            localStorage.setItem("token", response.data.data.token);
            router.push("/");
             toast.fire({
            icon: "success",
            title: "Compte créé avec succé",
        });
        } else {
           toast.fire({
            icon: "error",
            title: "!!!! Remplissez tout les champs et assurez vous que les passwords correspondent",
        });
        }
    });
};

onMounted(async () => {
    await getLevels();
});
</script>

<template>
    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <h2 class="alert alert-danger" v-for="error in errors" :key="error.id">
                {{error}}
        </h2>
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
                            <!-- SVG Image elearg.jpeg el.webp-->
                            <img
                                src="assets/images/element/02.svg"
                                class="mt-5"
                                alt=""
                            />
                        </div>
                    </div>

                    <!-- Right -->
                    <div class="col-12 col-lg-6 m-auto">
                        <div class="row mt-1 my-5">
                            <div class="col-sm-10 col-xl-8 m-auto">
                                <!-- Title -->
                                <img
                                    src="assets/images/element/03.svg"
                                    class="h-40px"
                                    alt=""
                                />
                                <h4>Inscrivez-vous à EduqMe!</h4>


                                <!-- Form START -->
                                <form @submit.prevent="register()">
                                    <!-- Name -->
                                    <div class="m-1">
                                        <label
                                            for="exampleInputEmail1"
                                            class="form-label"
                                            >Full Name *</label
                                        >
                                        <div class="input-group input-group-lg">
                                            <span
                                                class="input-group-text bg-light rounded-start border-0 text-secondary px-3"
                                                ><i class="fas fa-user"></i></span>
                                            <input
                                                type="text"
                                                class="form-control border-0 bg-light rounded-end ps-1"
                                                placeholder="Name"
                                                v-model="form.name"
                                                id="exampleInputEmail1"
                                            />
                                            <p>{{errors.name}}</p>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label
                                                for="exampleInputEmail1"
                                                class="form-label"
                                                >Niveau *</label
                                            >
                                        <div class="input-group input-group-lg">
                                            <span
                                                class="input-group-text bg-light rounded-start border-0 text-secondary px-3"
                                                ><i class="fas fa-graduation-cap"></i></span>
                                            <select
                                                name=""
                                                id=""
                                                v-model="form.level_id"
                                                class="form-control border-0 bg-light rounded-end ps-1"
                                                placeholder="Choisir ta classe"
                                            >
                                                <option
                                                    v-for="item in levels"
                                                    :key="item.id"
                                                    :value="item.id"
                                                >
                                                    {{ item.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-2">

                                            <label
                                                for="exampleInputEmail1"
                                                class="form-label mx-3"
                                                >Sex *</label
                                            >
                                        <div class="input-group input-group-lg">
                                             <span
                                                class="input-group-text bg-light rounded-start border-0 text-secondary px-3"
                                                ></span>
                                            <select
                                                name=""
                                                id=""
                                                v-model="form.sex"
                                                class="form-control border-0 bg-light rounded-end ps-1"
                                                placeholder="Sex"
                                            >
                                                <option value="masculin">
                                                    Masculin
                                                </option>
                                                <option value="feminin">
                                                    Feminin
                                                </option>
                                            </select>
                                        </div>
                                    </div>



                                    <!-- Email -->
                                    <div class="mb-2">
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
                                    <div class="mb-2">
                                        <label
                                            for="inputPassword5"
                                            class="form-label"
                                            >Password *</label
                                        >
                                        <div class="input-group input-group-lg">
                                            <span
                                                class="input-group-text bg-light rounded-start border-0 text-secondary px-1 "
                                                ><i class="fas fa-lock"></i
                                            ></span>
                                            <input
                                                type="password"
                                                v-model="form.password"
                                                class="form-control border-0 bg-light rounded-end ps-1"
                                                placeholder="*********"
                                                id="inputPassword5"
                                            />
                                        </div>
                                    </div>
                                    <!-- Confirm Password -->
                                    <div class="mb-2">
                                        <label
                                            for="inputPassword6"
                                            class="form-label"
                                            >Confirm Password *</label
                                        >
                                        <div class="input-group input-group-lg">
                                            <span
                                                class="input-group-text bg-light rounded-start border-0 text-secondary px-3"
                                                ><i class="fas fa-lock"></i
                                            ></span>
                                            <input
                                                type="password"
                                                v-model="form.c_password"
                                                class="form-control border-0 bg-light rounded-end ps-1"
                                                placeholder="*********"
                                                id="inputPassword6"
                                            />
                                        </div>
                                    </div><br>


                                    <!-- Button -->
                                    <div class="align-items-center mt-0">
                                        <div class="d-grid">
                                            <button
                                                class="btn btn-primary mb-0"
                                                type="submit"
                                            >
                                                Sign Up
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Form END -->
                                 <!-- Sign up link -->
                                <div class="mt-4 text-center">
                                    <span
                                        >Vous êtes déjà membre?
                                        <router-link to="/login"
                                            >Connectez-vous ici</router-link
                                        ></span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
