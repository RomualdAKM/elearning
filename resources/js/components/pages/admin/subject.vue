<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import sideBar from "./sidebar.vue";

const subjects = ref([]);
const levels = ref([]);
const editMode = ref(false);
const form = ref({
    name: "",
    level_id: "",
});

const getLevels = async () => {
    let response = await axios.get("/api/get_levels");
    console.log("levels", response.data.levels);
    levels.value = response.data.levels;
};

const getSubjects = async () => {
    let response = await axios.get("/api/get_subjects");
    console.log("subjects", response.data.subjects);
    subjects.value = response.data.subjects;
};

const createNewSubject = async () => {
    await axios.post("/api/create_subject", form.value).then((response) => {
        getSubjects();
        form.value = {};
        editMode.value = false;
        toast.fire({
            icon: "success",
            title: "subject add Successfully",
        });
        console.log(response);
    });
};

const editModal = (subject) => {
    editMode.value = true;
    form.value = subject;
};

const updateSubject = async () => {
    await axios
        .post("/api/update_subject/" + form.value.id, form.value)
        .then(() => {
            getSubjects();
            form.value = {};
            editMode.value = false;
            toast.fire({
                icon: "success",
                title: "subject update Successfully",
            });
        });
};

const deleteSubject = (id) => {
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
            axios.get("/api/delete_subject/" + id).then(() => {
                Swal.fire("Delete", "Subject delete successfully", "success");
                getSubjects();
            });
        }
    });
};

onMounted(async () => {
    getLevels();
    getSubjects();
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
		<div class="bg-blue h-100px h-md-200px rounded-0"
        style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
		</div>
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
                                    <!-- Button -->
                                    <!-- Button -->
                                    <div
                                        class="d-flex align-items-center mt-2 mt-md-0"
                                    >
                                        <a
                                            href="#"
                                            class="btn btn-sm btn-primary mb-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addQuiz"
                                            >Ajoutez Matiere</a
                                        >
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
                                <h3 class="mb-0">Liste des Matiers</h3>
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
                                                    ID niveau
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
                                                v-for="subject in subjects"
                                                :key="subject.id"
                                            >
                                                <!-- Course item -->
                                                <td>
                                                    <div
                                                        class="d-flex align-items-center"
                                                    >
                                                        <div class="mb-0 ms-2">
                                                            <!-- Title -->
                                                            <h6>
                                                                {{
                                                                    subject.id
                                                                }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- Enrolled item -->
                                                <td
                                                    class="text-center text-sm-start"
                                                >
                                                    {{ subject.name }}
                                                </td>
                                                <!-- Status item -->
                                                <td>
                                                    <div
                                                        class="badge bg-success bg-opacity-10 text-success"
                                                    >
                                                        {{
                                                            subject.level_id
                                                        }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <button
                                                        class="btn btn-sm btn-success-soft btn-round me-1 mb-0"
                                                        @click="
                                                            editModal(subject)
                                                        "
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#addQuiz"
                                                    >
                                                        <i
                                                            class="far fa-fw fa-edit"
                                                        ></i>
                                                    </button>
                                                    <button
                                                        class="btn btn-sm btn-danger-soft btn-round mb-0"
                                                        @click="
                                                            deleteSubject(
                                                                subject.id
                                                            )
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

        <!-- Add course modal START -->
        <div
            class="modal fade"
            id="addQuiz"
            tabindex="-1"
            aria-labelledby="addQuizLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5
                            class="modal-title text-white"
                            id="addQuizLabel"
                            v-show="editMode == false"
                        >
                            Ajoutez Matiere
                        </h5>
                        <h5
                            class="modal-title text-white"
                            id="addQuizLabel"
                            v-show="editMode == true"
                        >
                            Mettre SA
                        </h5>

                        <button
                            type="button"
                            class="btn btn-sm btn-light mb-0"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form
                            class="row text-start g-3"
                            @submit.prevent="
                                editMode
                                    ? updateSubject()
                                    : createNewSubject()
                            "
                        >
                            <div class="col-12">
                                <label class="form-label">Name Maitere</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    v-model="form.name"
                                    placeholder="Nom de la classe"
                                />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Name Niveau</label>

                                <select
                                    class="form-control"
                                    name=""
                                    id=""
                                    v-model="form.level_id"
                                >
                                    <option
                                        :value="level.id"
                                        v-for="level in levels"
                                        :key="level.id"
                                    >
                                        {{ level.name }}
                                    </option>
                                </select>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-danger-soft my-0"
                                data-bs-dismiss="modal"
                            >
                                Close
                            </button>
                            <button
                                type="button"
                                class="btn btn-success my-0"
                                v-show="editMode == false"
                                @click="createNewSubject()"
                            >
                                Ajoutez Matiere
                            </button>
                            <button
                                type="button"
                                class="btn btn-success my-0"
                                v-show="editMode == true"
                                @click="updateSubject()"
                            >
                                Mettre ajout Matiere
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add course modal START -->
    </main>
    <!-- **************** MAIN CONTENT END **************** -->
</template>
