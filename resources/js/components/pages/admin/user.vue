<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import sideBar from "./sidebar.vue";

const users = ref([]);
const searchUser = ref();
const form = ref({
    name: "",
});

const getUsers = async () => {
    let response = await axios.get("/api/get_users");
    console.log("users", response.data.users);
    users.value = response.data.users;
};

const search = async () => {
    let response = await axios.get("/api/search_user?s=" + searchUser.value);

    users.value = response.data.user;

    console.log("search", response.data.user);
};

const deleteUser = (id) => {
    Swal.fire({
        title: "Are you sure ?",
        text: "You can't go back",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it !",
    }).then((result) => {
        if (result.value) {
            axios.get("/api/delete_user/" + id).then(() => {
                Swal.fire("Delete", "User delete successfully", "success");
                getUsers();
            });
        }
    });
};

onMounted(async () => {
    getUsers();
});
</script>

<template>
    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <!-- =======================
Main Banner START -->
        <section class="pt-0">
            <!-- Main banner background image -->
            <div class="container-fluid px-0">
                <div
                    class="bg-blue h-100px h-md-200px rounded-0"
                    style="
                        background: url(assets/images/pattern/04.png) no-repeat
                            center center;
                        background-size: cover;
                    "
                ></div>
            </div>
            <div class="container mt-n4">
                <div class="row">
                    <!-- Profile banner START -->
                    <div class="col-12">
                        <div class="card bg-transparent card-body p-0">
                            <div class="row d-flex justify-content-between">
                                <!-- Avatar -->
                                <div class="col-auto mt-4 mt-md-0">
                                    <div class="avatar avatar-xxl mt-n3">
                                        <img
                                            class="avatar-img rounded-circle border border-white border-3 shadow"
                                            src="assets/images/avatar/01.jpg"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <!-- Profile info -->
                                <div
                                    class="col d-md-flex justify-content-between align-items-center mt-4"
                                >
                                    <div>
                                        <h1 class="my-1 fs-4">
                                            Admin
                                            <i
                                                class="bi bi-patch-check-fill text-info small"
                                            ></i>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Profile banner END -->

                        <!-- Advanced filter responsive toggler START -->
                        <!-- Divider -->
                        <hr class="d-xl-none" />
                        <div
                            class="col-12 col-xl-3 d-flex justify-content-between align-items-center"
                        >
                            <a class="h6 mb-0 fw-bold d-xl-none" href="#"
                                >Menu</a
                            >
                            <button
                                class="btn btn-primary d-xl-none"
                                type="button"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasSidebar"
                                aria-controls="offcanvasSidebar"
                            >
                                <i class="fas fa-sliders-h"></i>
                            </button>
                        </div>
                        <!-- Advanced filter responsive toggler END -->
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
Main Banner END -->

        <!-- =======================
Inner part START -->
        <section class="pt-0">
            <div class="container">
                <div class="row">
                    <side-bar></side-bar>
                    <!-- Main content START -->
                    <div class="col-xl-9">
                        <!-- Card START -->
                        <div class="card border bg-transparent rounded-3">
                            <!-- Card header START -->
                            <div
                                class="card-header bg-transparent border-bottom"
                            >
                                <h3 class="mb-0">Liste des Apprenants</h3>
                            </div>
                            <!-- Card header END -->

                            <!-- Card body START -->
                            <div class="card-body">
                                <!-- Search and select START -->
                                <div
                                    class="row g-3 align-items-center justify-content-between mb-4"
                                >
                                    <!-- Search -->
                                    <div class="col-md-8">
                                        <form class="rounded position-relative">
                                            <input

                                                 v-model="searchUser" @keyup="search()"
                                                class="form-control pe-5 bg-transparent"
                                                type="search"
                                                placeholder="Search"
                                                aria-label="Search"
                                            />
                                            <button
                                                class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                                                type="submit"
                                            >
                                                <i
                                                    class="fas fa-search fs-6"
                                                ></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Search and select END -->

                                <!-- Course list table START -->
                                <div class="table-responsive border-0">
                                    <table
                                        class="table table-dark-gray align-middle p-4 mb-0 table-hover"
                                    >
                                        <!-- Table head -->
                                        <thead>
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="border-0 rounded-start"
                                                >
                                                    Id
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="border-0"
                                                >
                                                    Nom
                                                </th>

                                                <th
                                                    scope="col"
                                                    class="border-0"
                                                >
                                                    Date Creation
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="border-0 rounded-end"
                                                >
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>

                                        <!-- Table body START -->
                                        <tbody>
                                            <!-- Table item -->
                                            <tr
                                                v-for="user in users"
                                                :key="user.id"
                                            >
                                                <!-- Course item -->
                                                <td>
                                                    <div
                                                        class="d-flex align-items-center"
                                                    >
                                                        <div class="mb-0 ms-2">
                                                            <!-- Title -->
                                                            <h6>
                                                                {{ user.id }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- Enrolled item -->
                                                <td
                                                    class="text-center text-sm-start"
                                                >
                                                    {{ user.name }}
                                                </td>
                                                <!-- Status item -->
                                                <td>
                                                    <div
                                                        class="badge bg-success bg-opacity-10 text-success"
                                                    >
                                                        {{ user.created_at }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <!-- <button  class="btn btn-sm btn-success-soft btn-round me-1 mb-0"
                                                @click="editModal(level)"
                                            data-bs-toggle="modal"  data-bs-target="#addQuiz"><i class="far fa-fw fa-edit"></i></button> -->
                                                    <button
                                                        class="btn btn-sm btn-danger-soft btn-round mb-0"
                                                        @click="
                                                            deleteUser(user.id)
                                                        "
                                                    >
                                                        <i
                                                            class="fas fa-fw fa-times"
                                                        ></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!-- Table body END -->
                                    </table>
                                </div>
                                <!-- Course list table END -->

                                <!-- Pagination START -->
                                <div
                                    class="d-sm-flex justify-content-sm-between align-items-sm-center mt-4 mt-sm-3"
                                >
                                    <!-- Content -->
                                    <p class="mb-0 text-center text-sm-start">
                                        Showing 1 to 8 of 20 entries
                                    </p>
                                    <!-- Pagination -->
                                    <nav
                                        class="d-flex justify-content-center mb-0"
                                        aria-label="navigation"
                                    >
                                        <ul
                                            class="pagination pagination-sm pagination-primary-soft d-inline-block d-md-flex rounded mb-0"
                                        >
                                            <li class="page-item mb-0">
                                                <a
                                                    class="page-link"
                                                    href="#"
                                                    tabindex="-1"
                                                    ><i
                                                        class="fas fa-angle-left"
                                                    ></i
                                                ></a>
                                            </li>
                                            <li class="page-item mb-0">
                                                <a class="page-link" href="#"
                                                    >1</a
                                                >
                                            </li>
                                            <li class="page-item mb-0 active">
                                                <a class="page-link" href="#"
                                                    >2</a
                                                >
                                            </li>
                                            <li class="page-item mb-0">
                                                <a class="page-link" href="#"
                                                    >3</a
                                                >
                                            </li>
                                            <li class="page-item mb-0">
                                                <a class="page-link" href="#"
                                                    ><i
                                                        class="fas fa-angle-right"
                                                    ></i
                                                ></a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Pagination END -->
                            </div>
                            <!-- Card body START -->
                        </div>
                        <!-- Card END -->
                    </div>
                    <!-- Main content END -->
                </div>
                <!-- Row END -->
            </div>
        </section>
        <!-- =======================
Inner part END -->
    </main>
    <!-- **************** MAIN CONTENT END **************** -->
</template>
