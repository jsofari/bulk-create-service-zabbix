<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input dari textarea
    $input_text = $_POST['kata'];

    // Pisahkan input menjadi array berdasarkan baris baru
    $input_lines = explode("\n", $input_text);

    // Loop melalui setiap baris input
    foreach ($input_lines as $input_line) {
        // Bersihkan baris input dari whitespace yang tidak perlu
        $input_line = trim($input_line);

        // Cek apakah baris input tidak kosong
        if (!empty($input_line)) {

            $response = createService($input_line);
            print_r($response);

	    echo "<script>
                setTimeout(function() {
                    window.location.href = 'index.html';
                }, 5000);
            </script>";

            // Tampilkan respons
        }
    }
}

// Fungsi untuk membuat permintaan API Zabbix
function createService($input_kata) {
    // URL API Zabbix Anda
    $url = 'http://example.com/zabbix/api_jsonrpc.php';

    // Header untuk permintaan
    $headers = array(
        'Content-Type: application/json-rpc',
    );

    // Data yang akan dikirim dalam permintaan
    $data = array(
        'jsonrpc' => '2.0',
        'method' => 'service.create',
        'params' => array(
            'name' => $input_kata,
            'algorithm' => 0,
            'sortorder' => 0,
            'parents' => array(
                array(
                    'serviceid' => '5'
                )
            ),
            'tags' => array(
                array(
                    'tag' => 'name', // ganti dengan name dari service tag SLA
                    'value' => 'value'  // ganti dengan value dari service tag SLA
                )
            ),
            'problem_tags' => array(
                array(
                    'tag' => 'name',
                    'operator' => 0,
                    'value' => $input_kata
                )
            ),
            'status_rules' => array(
                array(
                    'type' => 0,
                    'limit_value' => 1,
                    'limit_status' => 4,
                    'new_status' => 4
                )
            )
        ),
        'auth' => '{{ auth id }}', // ganti dengan auth id tanpa {{ }}
        'id' => 1
    );
    // Inisialisasi curl
    $ch = curl_init();

    // Set URL
    curl_setopt($ch, CURLOPT_URL, $url);

    // Set method POST
    curl_setopt($ch, CURLOPT_POST, 1);

    // Set data yang akan dikirim dalam permintaan
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Set header
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Ubah hasil yang diterima ke format JSON
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Eksekusi permintaan
    $hasil = curl_exec($ch);

    // Tutup curl
    curl_close($ch);

    // Mengembalikan respons dalam bentuk array
    return json_decode($hasil, true);


    return $hasil;
}
?>
