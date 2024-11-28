<script>
    function formatToSlug(inputText) {
        // Bảng chuyển đổi ký tự có dấu sang không dấu
        const vietnameseMap = {
            'à': 'a',
            'á': 'a',
            'ạ': 'a',
            'ả': 'a',
            'ã': 'a',
            'â': 'a',
            'ầ': 'a',
            'ấ': 'a',
            'ậ': 'a',
            'ẩ': 'a',
            'ẫ': 'a',
            'ă': 'a',
            'ằ': 'a',
            'ắ': 'a',
            'ặ': 'a',
            'ẳ': 'a',
            'ẵ': 'a',
            'è': 'e',
            'é': 'e',
            'ẹ': 'e',
            'ẻ': 'e',
            'ẽ': 'e',
            'ê': 'e',
            'ề': 'e',
            'ế': 'e',
            'ệ': 'e',
            'ể': 'e',
            'ễ': 'e',
            'ì': 'i',
            'í': 'i',
            'ị': 'i',
            'ỉ': 'i',
            'ĩ': 'i',
            'ò': 'o',
            'ó': 'o',
            'ọ': 'o',
            'ỏ': 'o',
            'õ': 'o',
            'ô': 'o',
            'ồ': 'o',
            'ố': 'o',
            'ộ': 'o',
            'ổ': 'o',
            'ỗ': 'o',
            'ơ': 'o',
            'ờ': 'o',
            'ớ': 'o',
            'ợ': 'o',
            'ở': 'o',
            'ỡ': 'o',
            'ù': 'u',
            'ú': 'u',
            'ụ': 'u',
            'ủ': 'u',
            'ũ': 'u',
            'ư': 'u',
            'ừ': 'u',
            'ứ': 'u',
            'ự': 'u',
            'ử': 'u',
            'ữ': 'u',
            'ỳ': 'y',
            'ý': 'y',
            'ỵ': 'y',
            'ỷ': 'y',
            'ỹ': 'y',
            'đ': 'd',
            'À': 'A',
            'Á': 'A',
            'Ạ': 'A',
            'Ả': 'A',
            'Ã': 'A',
            'Â': 'A',
            'Ầ': 'A',
            'Ấ': 'A',
            'Ậ': 'A',
            'Ẩ': 'A',
            'Ẫ': 'A',
            'Ă': 'A',
            'Ằ': 'A',
            'Ắ': 'A',
            'Ặ': 'A',
            'Ẳ': 'A',
            'Ẵ': 'A',
            'È': 'E',
            'É': 'E',
            'Ẹ': 'E',
            'Ẻ': 'E',
            'Ẽ': 'E',
            'Ê': 'E',
            'Ề': 'E',
            'Ế': 'E',
            'Ệ': 'E',
            'Ể': 'E',
            'Ễ': 'E',
            'Ì': 'I',
            'Í': 'I',
            'Ị': 'I',
            'Ỉ': 'I',
            'Ĩ': 'I',
            'Ò': 'O',
            'Ó': 'O',
            'Ọ': 'O',
            'Ỏ': 'O',
            'Õ': 'O',
            'Ô': 'O',
            'Ồ': 'O',
            'Ố': 'O',
            'Ộ': 'O',
            'Ổ': 'O',
            'Ỗ': 'O',
            'Ơ': 'O',
            'Ờ': 'O',
            'Ớ': 'O',
            'Ợ': 'O',
            'Ở': 'O',
            'Ỡ': 'O',
            'Ù': 'U',
            'Ú': 'U',
            'Ụ': 'U',
            'Ủ': 'U',
            'Ũ': 'U',
            'Ư': 'U',
            'Ừ': 'U',
            'Ứ': 'U',
            'Ự': 'U',
            'Ử': 'U',
            'Ữ': 'U',
            'Ỳ': 'Y',
            'Ý': 'Y',
            'Ỵ': 'Y',
            'Ỷ': 'Y',
            'Ỹ': 'Y',
            'Đ': 'D'
        };

        const slug = inputText.split('').map(char => vietnameseMap[char] || char).join('');

        return slug
            .toLowerCase()
            .trim()
            .replace(/[\s\W-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }


    document.addEventListener('DOMContentLoaded', function() {
        const inputSource = document.getElementById('title'); 
        const inputTarget = document.getElementById('slug'); 

        if (inputSource && inputTarget) {
            inputSource.addEventListener('input', function() {
                inputTarget.value = formatToSlug(inputSource.value);
            });
        } 
    });
</script>

<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
    import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-messaging.js";
    
    const firebaseConfig = {
        apiKey: "AIzaSyADoX7jz4ESYSVmYozwKRCyCSiMKgKrQoM",
        authDomain: "app-tmdt-97150.firebaseapp.com",
        projectId: "app-tmdt-97150",
        storageBucket: "app-tmdt-97150.appspot.com",
        messagingSenderId: "925256118208",
        appId: "1:925256118208:web:47e23b8d635065e0b7e225",
        measurementId: "G-BJCL2E7522"
    };

    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);
    
    getToken(messaging, { vapidKey: 'BIV6tWvfebfZKSNVZqgpkWY2EzVWbheWq1u0fIMomXhAaXYewyNKMEKWTyhIO7EcqgBiBGbXwLzxVVyblc2-dDQ' })
        .then((token) => {
            if (token) {
                console.log("Device token:", token);
                const deviceTokenInput = document.getElementById('device_token');
                if (deviceTokenInput) {
                    deviceTokenInput.value = token || '';
                } 
            } else {
                console.log("No registration token available.");
            }
        })
        .catch((error) => {
            console.error("Error getting device token:", error);
        });
</script>
