const apiUrlTinh = 'https://esgoo.net/api-tinhthanh/1/0.htm';

// Fetch dữ liệu từ API Tỉnh
async function fetchTinhThanh() {
    try {
        const response = await fetch(apiUrlTinh);
        const data = await response.json();
        displayTinhThanh(data.data);
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

// Fetch dữ liệu Huyện/Quận theo Tỉnh
async function fetchHuyen(idTinh) {
    const apiUrlQuan = `https://esgoo.net/api-tinhthanh/2/${idTinh}.htm`;
    try {
        const response = await fetch(apiUrlQuan);
        const data = await response.json();
        displayHuyen(data.data);
    } catch (error) {
        console.error('Error fetching districts:', error);
    }
}

// Fetch dữ liệu Xã/Phường theo Huyện
async function fetchXa(idHuyen) {
    const apiUrlXa = `https://esgoo.net/api-tinhthanh/3/${idHuyen}.htm`;
    try {
        const response = await fetch(apiUrlXa);
        const data = await response.json();
        displayXa(data.data);
    } catch (error) {
        console.error('Error fetching wards:', error);
    }
}

// Hiển thị Tỉnh/Thành phố
function displayTinhThanh(data) {
    const tinhSelect = document.getElementById('tinhthanh');
    tinhSelect.innerHTML = '<option value="">--Chọn Tỉnh/Thành phố--</option>';
    data.sort((a, b) => a.name.localeCompare(b.name));

    data.forEach(tinh => {
        const option = document.createElement('option');
        option.value = tinh.id;
        option.text = tinh.name;
        tinhSelect.appendChild(option);
    });

    tinhSelect.addEventListener('change', function() {
        const selectedId = this.value;
        if (selectedId) {
            fetchHuyen(selectedId);
        } else {
            document.getElementById('huyen').innerHTML = '<option value="">--Chọn Huyện/Quận--</option>';
            document.getElementById('xa').innerHTML = '<option value="">--Chọn Phường/Xã--</option>';
        }
        updateAddress();
    });
}

// Hiển thị Huyện/Quận
function displayHuyen(huyenData) {
    const huyenSelect = document.getElementById('huyen');
    huyenSelect.innerHTML = '<option value="">--Chọn Huyện/Quận--</option>';
    huyenData.sort((a, b) => a.full_name.localeCompare(b.full_name));

    huyenData.forEach(huyen => {
        const option = document.createElement('option');
        option.value = huyen.id;
        option.text = huyen.full_name;
        huyenSelect.appendChild(option);
    });

    huyenSelect.addEventListener('change', function() {
        const selectedId = this.value;
        if (selectedId) {
            fetchXa(selectedId);
        } else {
            document.getElementById('xa').innerHTML = '<option value="">--Chọn Phường/Xã--</option>';
        }
        updateAddress();
    });
}

// Hiển thị Xã/Phường
function displayXa(xaData) {
    const xaSelect = document.getElementById('xa');
    xaSelect.innerHTML = '<option value="">--Chọn Phường/Xã--</option>';
    xaData.sort((a, b) => a.name.localeCompare(b.name));

    xaData.forEach(xa => {
        const option = document.createElement('option');
        option.value = xa.id;
        option.text = xa.full_name;
        xaSelect.appendChild(option);
    });

    xaSelect.addEventListener('change', function() {
        updateAddress();
    });
}

// Hàm cập nhật địa chỉ vào input
function updateAddress() {
    const tinhText = document.getElementById('tinhthanh').options[document.getElementById('tinhthanh').selectedIndex].text;
    const huyenText = document.getElementById('huyen').options[document.getElementById('huyen').selectedIndex].text;
    const xaText = document.getElementById('xa').options[document.getElementById('xa').selectedIndex].text;

    const address = `${xaText}, ${huyenText}, ${tinhText}`;
    document.getElementById('address').value = address;
}

// Gọi hàm fetch khi tải trang
fetchTinhThanh();