<?php
class database
{

    private $servername;
    private $user_db;
    private $password_db;
    private $database;
    private $koneksi;

    /**
     * Constructor untuk koneksi ke database
     * Menginisialisasi properti koneksi dari hasil panggilan connect_db()
     */
    function __construct()
    {
        $this->load_conf_db(); // Memuat konfigurasi koneksi dari file eksternal
        $this->connect_db(); // Menghubungkan ke database menggunakan konfigurasi yang dimuat
    }

    /**
     * Memuat konfigurasi database dari file koneksi.php jika ada
     */
    function load_conf_db()
    {
        $path = dirname(__FILE__) . '/koneksi.php';
        if (file_exists($path)) {
            $conf = include $path;
            $this->servername = @$conf['host'];
            $this->database = @$conf['dbname'];
            $this->user_db = @$conf['username'];
            $this->password_db = @$conf['password'];
        }
    }

    /**
     * Menghubungkan ke database menggunakan konfigurasi yang telah dimuat
     * @return mysqli|null
     */
    public function connect_db()
    {
        $this->koneksi = mysqli_connect($this->servername, $this->user_db, $this->password_db, $this->database);
        if (!$this->koneksi) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    /**
     * Eksekusi query SQL
     * @param string $sql Query SQL yang akan dieksekusi
     * @return bool|mysqli_result Hasil eksekusi query
     */
    function db_query($sql)
    {
        return mysqli_query($this->koneksi, $sql);
    }

    /**
     * Mendapatkan pesan kesalahan dari operasi database terakhir
     * @param $result Hasil dari operasi database
     * @return string Pesan kesalahan MySQL
     */
    function db_error($result)
    {
        return mysqli_error($this->koneksi);
    }

    /**
     * Mendapatkan array asosiatif dari hasil query SELECT
     * @param $result Hasil dari query SELECT
     * @return array|null Hasil dalam bentuk array asosiatif
     */
    function db_fetch_array($result)
    {
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    /**
     * Mendapatkan jumlah baris dari hasil query SELECT
     * @param $result Hasil dari query SELECT
     * @return int Jumlah baris
     */
    function db_num_rows($result)
    {
        return mysqli_num_rows($result);
    }

    /**
     * Mendapatkan ID yang di-generate oleh operasi INSERT terakhir
     * @return int ID yang di-generate oleh operasi INSERT
     */
    function db_insert_id()
    {
        return mysqli_insert_id($this->koneksi);
    }

    //==============================================================================

    /**
     * Memasukkan record baru ke dalam tabel
     * @param string $table Nama tabel
     * @param array $val_cols Array asosiatif kolom => nilai
     * @return bool Hasil eksekusi query
     */
    function insert_record($table, array $val_cols)
    {
        $fields = implode("`, `", array_keys($val_cols));
        $values = implode("', '", array_values($val_cols));
        $sql = "INSERT INTO $table (`$fields`) VALUES ('$values')";
        return $this->db_query($sql);
    }

    /**
     * Menghapus record dari tabel berdasarkan kondisi
     * @param string $table Nama tabel
     * @param array $val_cols Kondisi sebagai array kolom => nilai
     * @return bool Hasil eksekusi query
     */
    function delete_record($table, array $val_cols)
    {
        $conditions = array();
        foreach ($val_cols as $key => $value) {
            $conditions[] = "$key = '$value'";
        }
        $where_clause = implode(" AND ", $conditions);
        $sql = "DELETE FROM $table WHERE $where_clause";
        return $this->db_query($sql);
    }

    /**
     * Memperbarui record dalam tabel berdasarkan kondisi
     * @param string $table Nama tabel
     * @param array $set_val_cols Array asosiatif untuk kolom yang akan di-update
     * @param array $cod_val_cols Kondisi sebagai array kolom => nilai
     * @return bool Hasil eksekusi query
     */
    function update_record($table, array $set_val_cols, array $cod_val_cols)
    {
        $set_clause = implode(", ", array_map(function ($key, $value) {
            return "$key = '$value'";
        }, array_keys($set_val_cols), array_values($set_val_cols)));

        $conditions = array();
        foreach ($cod_val_cols as $key => $value) {
            $conditions[] = "$key = '$value'";
        }
        $where_clause = implode(" AND ", $conditions);

        $sql = "UPDATE $table SET $set_clause WHERE $where_clause";
        return $this->db_query($sql);
    }

    //--------------------------------------------------------------------------

    /**
     * Menghitung jumlah data dalam tabel
     * @param string $table Nama tabel
     * @param string $field Kolom yang dihitung
     * @param string $where Kondisi WHERE (opsional)
     * @return array|null Hasil dalam bentuk array asosiatif
     */
    function count_data($table, $field, $where = null)
    {
        $sql = "SELECT COUNT($field) AS count FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        $result = $this->db_query($sql);
        return $this->db_fetch_array($result);
    }

    /**
     * Menampilkan semua kolom dari tabel
     * @param string $table Nama tabel
     * @param string $where Kondisi WHERE (opsional)
     * @param bool $fetch Mengembalikan hasil fetch_array atau hanya query (opsional, default false)
     * @param bool $limit Menggunakan LIMIT (opsional, default false)
     * @param int $limit_offset Posisi awal LIMIT (opsional, default 0)
     * @param int $limit_count Jumlah batasan LIMIT (opsional, default 0)
     * @param string $sort Klausa ORDER BY (opsional, default '')
     * @return array|null|bool Hasil fetch_array atau query (tergantung pada $fetch)
     */
    function display_table_all_column($table, $where = null, $fetch = false, $limit = false, $limit_offset = 0, $limit_count = 0, $sort = '')
    {
        $sql = "SELECT * FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        if (!empty($sort)) {
            $sql .= " ORDER BY $sort";
        }
        if ($limit) {
            $sql .= " LIMIT $limit_offset, $limit_count";
        }
        return ($fetch) ? $this->db_fetch_array($this->db_query($sql)) : $this->db_query($sql);
    }

    /**
     * Mencari nilai dalam tabel berdasarkan kolom
     * @param string $table Nama tabel
     * @param array|string $find_column Kolom yang dicari
     * @param string $where Kondisi WHERE (opsional)
     * @return array|null Hasil dalam bentuk array asosiatif
     */
    function find_in_table($table, $find_column = array(), $where = '')
    {
        $columns = (is_array($find_column)) ? implode(", ", $find_column) : $find_column;
        $sql = "SELECT $columns FROM $table $where";
        $result = $this->db_query($sql);
        return $this->db_fetch_array($result);
    }

    /**
     * Memeriksa apakah data ada dalam tabel
     * @param string $table Nama tabel
     * @param string $field Kolom yang diperiksa
     * @param string $value Nilai yang dicari dalam kolom
     * @return bool True jika data ada, False jika tidak ada
     */
    function cek_data_is_in_table($table, $field, $value)
    {
        $sql = "SELECT COUNT($field) AS count FROM $table WHERE $field = '$value'";
        $result = $this->db_query($sql);
        $row = $this->db_fetch_array($result);
        return ($row['count'] > 0);
    }

    /**
     * Mendapatkan data login berdasarkan ID login
     * @param int $id_login ID login yang dicari
     * @return array|null Data login dalam bentuk array asosiatif
     */
    function get_login_by_id($id_login)
    {
        $sql = "SELECT * FROM login WHERE id_login = $id_login";
        $result = $this->db_query($sql);
        return $this->db_fetch_array($result);
    }
}
