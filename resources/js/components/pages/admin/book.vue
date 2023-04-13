<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const books = ref([])
const levels = ref([])
const categories = ref([])
const editMode = ref(false)
const form = ref({
    name: "",
    description: "",
    level_id: "",
    category_id: "",
})

const image = ref(null)
const file = ref(null)


const onFile = (e) => {
    file.value = e.target.files[0]
}
const onImage = (e) => {
    image.value = e.target.files[0]
}
const getLevels = async () => {
    let response = await axios.get('/api/get_levels')
    console.log('levels', response.data.levels)
    levels.value = response.data.levels
}
const getCategories = async () => {
    let response = await axios.get('/api/get_categories')
    console.log('categories', response.data.categories)
    categories.value = response.data.categories
}

const getBooks = async () => {
    let response = await axios.get("/api/get_books");
    console.log("quizzes", response.data.books);
    books.value = response.data.books;
};

const createNewBook = async () => {
      const formData = new FormData();
      formData.append('name', form.value.name);
      formData.append('file', file.value);
      formData.append('description', form.value.description);
      formData.append('image', image.value);
      formData.append('level_id', form.value.level_id);
      formData.append('category_id', form.value.category_id);

    await axios.post("/api/create_book", formData).then((response) => {
        getBooks();
        form.value = {};
        file.value = {}
        image.value = {}
        editMode.value = false;
        toast.fire({
            icon: "success",
            title: "Book add Successfully",
        });
        console.log(response);
    });
};

const editModal = (book) => {
    editMode.value = true;
    form.value = book;
};

const updateBook = async () => {
    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('file', file.value);
    formData.append('description', form.value.description);
    formData.append('image', image.value);
    formData.append('level_id', form.value.level_id);
    formData.append('category_id', form.value.category_id);

    await axios
        .post("/api/update_book/" + form.value.id, formData)
        .then(() => {
            getBooks();
            form.value = {};
            file.value = {}
            image.value = {}
            editMode.value = false;
            toast.fire({
                icon: "success",
                title: "Book update Successfully",
            });
        });
};

 const getImageUrl = (nomImage) => {
      return "/img/" + nomImage; // Chemin relatif de l'image dans le dossier public
}

const deleteBook = (id) => {
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
            axios.get("/api/delete_book/" + id).then(() => {
                Swal.fire("Delete", "book delete successfully", "success");
                getBooks();
            });
        }
    });
};



onMounted(async () => {
    getBooks()
    getLevels()
    getCategories()

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
                                            Lori Stevens
                                            <i
                                                class="bi bi-patch-check-fill text-info small"
                                            ></i>
                                        </h1>
                                        <ul class="list-inline mb-0">
                                            <li
                                                class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0"
                                            >
                                                <i
                                                    class="fas fa-star text-warning me-2"
                                                ></i
                                                >4.5/5.0
                                            </li>
                                            <li
                                                class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0"
                                            >
                                                <i
                                                    class="fas fa-user-graduate text-orange me-2"
                                                ></i
                                                >12k Enrolled Students
                                            </li>
                                            <li
                                                class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0"
                                            >
                                                <i
                                                    class="fas fa-book text-purple me-2"
                                                ></i
                                                >25 Courses
                                            </li>
                                        </ul>
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
                                            >Ajoutez un nouveau livre</a
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
                                <h3 class="mb-0">Liste des livres</h3>
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
                                                    class="border-0"
                                                >
                                                   Image
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
                                                v-for="book in books"
                                                :key="book.id"
                                            >
                                                <!-- Course item -->
                                                <td>
                                                    <div
                                                        class="d-flex align-items-center"
                                                    >
                                                        <div class="mb-0 ms-2">
                                                            <!-- Title -->
                                                            <h6>
                                                                {{ book.name }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="d-flex align-items-center"
                                                    >
                                                        <div class="mb-0 ms-2">
                                                            <!-- Title -->
                                                            <h6>
                                                               <img :src="getImageUrl(book.image)" alt="photo">
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>



                                                <td>
                                                    <button
                                                        class="btn btn-sm btn-success-soft btn-round me-1 mb-0"
                                                        @click="
                                                            editModal(book)
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
                                                            deleteBook(
                                                                book.id
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
                            Ajoutez nouvelle livre
                        </h5>
                        <h5
                            class="modal-title text-white"
                            id="addQuizLabel"
                            v-show="editMode == true"
                        >
                            Mettre ajout la livre
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
                                editMode ? updateBook() : createNewBook()
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
                                <label class="form-label">Image</label>
                                <input
                                    class="form-control"
                                    type="file"
                                    @change="onImage"
                                    placeholder="image"
                                />
                            </div> <div class="col-6">
                                <label class="form-label">PDF</label>
                                <input
                                    class="form-control"
                                    type="file"
                                    @change="onFile"
                                    placeholder="pdf"
                                />
                            </div>

                              <div class="col-6">
                                <label class="form-label">Nom Category</label>
                                <select class="form-control"  v-model="form.category_id">
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{category.name}}
                                    </option>


                               </select>
                            </div>
                             <div class="col-6">
                                <label class="form-label">Nom Niveau</label>
                                <select class="form-control"  v-model="form.level_id">
                                    <option v-for="level in levels" :key="level.id" :value="level.id">
                                        {{level.name}}
                                    </option>

                               </select>
                            </div>

                             <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea
                                    class="form-control"
                                    type="text"
                                    v-model="form.description"
                                    placeholder="option3"
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
                                @click="createNewBook()"
                            >
                                Ajoutez livre
                            </button>
                            <button
                                type="button"
                                class="btn btn-success my-0"
                                v-show="editMode == true"
                                @click="updateBook()"
                            >
                                Mettre ajout livre
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
