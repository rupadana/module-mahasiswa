import MahasiswaTable from "./components/MahasiswaTable";
import MahasiswaForm from "./components/MahasiswaForm";

export default [
  {
    path: "/mahasiswa/mahasiswas",
    name: "admin.mahasiswa.mahasiswa.index",
    component: MahasiswaTable
  },
  {
    path: "/mahasiswa/mahasiswas/create",
    name: "admin.mahasiswa.mahasiswa.create",
    component: MahasiswaForm
  },
  {
    path: "/mahasiswa/mahasiswas/:mahasiswa/edit",
    name: "admin.mahasiswa.mahasiswa.edit",
    component: MahasiswaForm
  }
];
