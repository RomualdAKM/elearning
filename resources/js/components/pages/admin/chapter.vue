<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import sideBar from './sidebar.vue'



const learnings = ref([])
const chapters = ref([])
const searchChapter = ref()
const editMode = ref(false)
const form = ref({
    name: "",
    description: "",
    learning_id: "",
    url: "",

})

const file = ref(null)


const onFile = (e) => {
    file.value = e.target.files[0]
}

const getLearnings = async () => {
    let response = await axios.get('/api/get_learnings')
    console.log('learnings', response.data.learnings)
    learnings.value = response.data.learnings
}

const search = async () => {

    let response = await axios.get('/api/search_chapter?s=' + searchChapter.value)

    chapters.value = response.data.chapter

    console.log('search', response.data.chapter)

}

const getChapters = async () => {
    let response = await axios.get("/api/get_chapters");
    console.log("chapters", response.data.chapters);
    chapters.value = response.data.chapters;
};

const createNewChapter = async () => {
      const formData = new FormData();
      formData.append('name', form.value.name);
      formData.append('file', file.value);
      formData.append('description', form.value.description);
      formData.append('url', form.value.url);
      formData.append('learning_id', form.value.learning_id);

    await axios.post("/api/create_chapter", formData).then((response) => {
        getChapters();
        form.value = {};
        file.value = {}
        editMode.value = false;
        toast.fire({
            icon: "success",
            title: "Chapter add Successfully",
        });
        console.log(response);
    });
};

const editModal = (chapter) => {
    editMode.value = true;
    form.value = chapter;
};

const updateChapter = async () => {
    const formData = new FormData();
      formData.append('name', form.value.name);
      formData.append('file', file.value);
      formData.append('description', form.value.description);
      formData.append('url', form.value.url);
      formData.append('learning_id', form.value.learning_id);

    await axios
        .post("/api/update_chapter/" + form.value.id, formData)
        .then(() => {
            getChapters();
            form.value = {};
            file.value = {}
            editMode.value = false;
            toast.fire({
                icon: "success",
                title: "Learning update Successfully",
            });
        });
};


const deleteChapter = (id) => {
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
            axios.get("/api/delete_chapter/" + id).then(() => {
                Swal.fire("Delete", "chapter delete successfully", "success");
                getChapters();
            });
        }
    });
};



onMounted(async () => {
    getChapters()
    getLearnings()


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
		<div class="bg-blue h-100px h-md-200px rounded-0" style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
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
                                            >Ajoutez chapitre</a
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
                                <h3 class="mb-0">Liste des chaptres</h3>
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
                                                v-model="searchChapter" @keyup="search()"
                                                class="form-control pe-5 bg-transparent"
                                                type="search"
                                                placeholder="Search"
                                                aria-label="Search"
                                            />

                                        </form>
                                    </div>
                                </div>
                                <!-- Search and select END -->

                                <!-- Course list table START -->
                                <div class="table-responsive border-0">
                                    <table
                                        class="table table-dark-gray align-middle  p-4 mb-0 table-hover"
                                    >
                                        <!-- Table head -->
                                        <thead>
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="border-0 rounded-start"
                                                >
                                                    Nom
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
                                                v-for="chapter in chapters"
                                                :key="chapter.id"
                                            >
                                                <!-- Course item -->
                                                <td>
                                                    <div
                                                        class="d-flex align-items-center"
                                                    >
                                                        <div class="mb-0 ms-2">
                                                            <!-- Title -->
                                                            <h6>
                                                                {{ chapter.name }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <button
                                                        class="btn btn-sm btn-success-soft btn-round me-1 mb-0"
                                                        @click="
                                                            editModal(chapter)
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
                                                            deleteChapter(
                                                                chapter.id
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
                            Ajoutez Chapitre
                        </h5>
                        <h5
                            class="modal-title text-white"
                            id="addQuizLabel"
                            v-show="editMode == true"
                        >
                            Mettre Chapitre
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
                                editMode ? updateChapter() : createNewChapter()
                            "
                        >
                            <div class="col-12">
                                <label class="form-label">Nom</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    v-model="form.name"
                                    placeholder="Nom de la classe"
                                />
                            </div>
                             <div class="col-6">
                                <label class="form-label">url video</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    v-model="form.url"
                                    placeholder="url"
                                />
                            </div>
                            <div class="col-6">
                                <label class="form-label">PDF</label>
                                <input
                                    class="form-control"
                                    type="file"
                                    @change="onFile"
                                    placeholder="pdf"
                                />
                            </div>

                              <div class="col-6">
                                <label class="form-label">Nom SA</label>
                                <select class="form-control"  v-model="form.learning_id">
                                    <option v-for="learning in learnings" :key="learning.id" :value="learning.id">
                                        {{learning.name}}
                                    </option>


                               </select>
                            </div>


                             <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea
                                    class="form-control"
                                    type="text"
                                    v-model="form.description"
                                    placeholder="Description"
                                />
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
                                @click="createNewChapter()"
                            >
                                Ajoutez Chapitre
                            </button>
                            <button
                                type="button"
                                class="btn btn-success my-0"
                                v-show="editMode == true"
                                @click="updateChapter()"
                            >
                                Mettre ajout Chapitre
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
