<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }

        .upload-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .upload-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn {
            background-color: #6c63ff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 500;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .upload-btn:hover {
            background-color: #574bdb;
        }

        .upload-btn-wrapper input[type="file"] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

        /* Selected File Display */
        .file-preview {
            margin-top: 20px;
            display: none;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .file-preview img {
            width: 50px;
            height: 50px;
        }

        .file-name {
            font-size: 14px;
            color: #333;
        }

        /* Submit Button */
        .submit-btn {
            margin-top: 20px;
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .upload-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="upload-container">
        <h2>Upload Your File</h2>
        <form action="{{ route('uploadFile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- File Input -->
            <div class="upload-btn-wrapper">
                <button class="upload-btn">Choose File</button>
                <input type="file" name="file" accept=".csv" id="fileInput">
            </div>

            <!-- File Preview -->
            <div class="file-preview" id="filePreview">
                <img src="https://img.icons8.com/ios-filled/50/000000/file.png" alt="File Icon">
                <span class="file-name" id="fileName">No file chosen</span>
            </div>
            <br>
            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Upload File</button>
        </form>
    </div>

    <script>
        // Get the file input and the file name display element
        const fileInput = document.getElementById('fileInput');
        const fileNameDisplay = document.getElementById('fileName');
        const filePreview = document.getElementById('filePreview');

        // Add event listener to the file input
        fileInput.addEventListener('change', function() {
            // Get the selected file
            const file = fileInput.files[0];

            if (file) {
                // Display the file name
                fileNameDisplay.textContent = file.name;
                filePreview.style.display = 'flex';  // Show the file preview container
            } else {
                // If no file selected, hide the preview
                fileNameDisplay.textContent = 'No file chosen';
                filePreview.style.display = 'none';
            }
        });
    </script>

</body>
</html>
