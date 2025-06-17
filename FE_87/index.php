<?php
require 'connection.php';
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $Status = $_POST["status"];
  
  if (empty($_POST["captured_image"])) {
    echo "<script> alert('No image captured'); </script>";
  } else {
    $imageData = $_POST["captured_image"];
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $decodedImage = base64_decode($imageData);
    
    $newImageName = uniqid() . '.png';
    file_put_contents('img/' . $newImageName, $decodedImage);
    
    $query = "INSERT INTO tb_upload (name, image, status) VALUES('$name', '$newImageName', '$Status')";
    mysqli_query($conn, $query);
    
    echo "<script> alert('Successfully Added'); </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Upload Image File</title>
    <style>
        body {
            background-color: wheat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
            position: relative;
        }
        .form-container {
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        video, canvas {
            width: 100%;
            max-height: 250px;
            border-radius: 5px;
        }
        h1 {
            color: #4a4a4a;
            font-family: Arial, sans-serif;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5em;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
        .nav-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .nav-buttons a {
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            background-color: transparent;
            color: black;
            border: 2px solid #007BFF;
            transition: background-color 0.3s, color 0.3s;
        }
        .nav-buttons a:hover {
            background-color: #007BFF;
            color: white;
        }
    </style>
</head>
<body>
    <div class="nav-buttons">
        <a href="meetings.html">Back to Login</a>
        <a href="index.html">Back to Home</a>
    </div>
    <h1>Image Upload Form</h1>
    <div class="form-container">
        <video id="video" autoplay></video>
        <canvas id="canvas" style="display: none;"></canvas>
        
        <form action="" method="post" autocomplete="off">
            <input type="hidden" name="captured_image" id="captured_image">
            <table>
                <tr>
                    <td><label>Name:</label></td>
                    <td><input type="text" name="name" id="name" ></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <label><input type="radio" name="status" value="alive" required> Alive</label>
                        <label><input type="radio" name="status" value="dead" required> Dead</label>
                        <label><input type="radio" name="status" value="injured" required> Injured</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="button" id="capture">Capture Image</button>
                        <button type="submit" name="submit">Submit</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureBtn = document.getElementById('capture');
        const capturedImageInput = document.getElementById('captured_image');

        // Access the device camera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(error => {
                console.error('Camera access denied:', error);
            });

        // Capture image
        captureBtn.addEventListener('click', () => {
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert image to base64
            const imageData = canvas.toDataURL('image/png');
            capturedImageInput.value = imageData;
            alert('Image Captured');
        });
    </script>
</body>
</html>
