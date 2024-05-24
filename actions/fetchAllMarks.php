<?php
include 'conn.php';

$data = array();

// Retrieve all distinct result types
$query = "SELECT DISTINCT resultType_id FROM marks";
$result = mysqli_query($conn, $query);

// Process each result type
while ($row = mysqli_fetch_assoc($result)) {
    $resultType = $row['resultType_id'];
    
    // Get result type name
    $resultTypeNameQuery = "SELECT type FROM result_types WHERE id = '$resultType'";
    $resultTypeNameResult = mysqli_query($conn, $resultTypeNameQuery);
    $resultTypeNameRow = mysqli_fetch_assoc($resultTypeNameResult);
    $resultTypeName = $resultTypeNameRow['type'];

    // Initialize result type data
    $resultTypeData = array(
        'resultType' => $resultTypeName,
        'details' => array()
    );

    // Get all subjects for this result type
    $subjectsQuery = "SELECT DISTINCT subject_id FROM marks WHERE resultType_id = '$resultType'";
    $subjectsResult = mysqli_query($conn, $subjectsQuery);
    $subjectIds = array();
    $subjectNames = array();
    while ($subjectRow = mysqli_fetch_assoc($subjectsResult)) {
        $subjectId = $subjectRow['subject_id'];
        $subjectNameQuery = "SELECT subject FROM subjects WHERE id = '$subjectId'";
        $subjectNameResult = mysqli_query($conn, $subjectNameQuery);
        $subjectNameRow = mysqli_fetch_assoc($subjectNameResult);
        if ($subjectNameRow && !empty($subjectNameRow['subject'])) {
            $subjectIds[] = $subjectId;
            $subjectNames[$subjectId] = $subjectNameRow['subject'];
        }
    }

    // Get all marks for this result type
    $marksQuery = "SELECT * FROM marks WHERE resultType_id = '$resultType'";
    $marksResult = mysqli_query($conn, $marksQuery);

    $studentMarks = array();
    while ($marksRow = mysqli_fetch_assoc($marksResult)) {
        $studentId = $marksRow['s_id'];
        $subjectId = $marksRow['subject_id'];

        // Get student details
        $studentDetailsQuery = "SELECT name, semester, branch, roll FROM users WHERE id = '$studentId'";
        $studentDetailsResult = mysqli_query($conn, $studentDetailsQuery);
        $studentDetailsRow = mysqli_fetch_assoc($studentDetailsResult);

        // Ensure student entry exists
        if (!isset($studentMarks[$studentId])) {
            $studentMarks[$studentId] = array(
                'name' => $studentDetailsRow['name'],
                'semester' => $studentDetailsRow['semester'],
                'branch' => $studentDetailsRow['branch'],
                'roll' => $studentDetailsRow['roll'],
                'marks' => array()
            );

            // Initialize all subjects with "-"
            foreach ($subjectIds as $subId) {
                $studentMarks[$studentId]['marks'][$subjectNames[$subId]] = "-";
            }
        }

        // Set the actual mark for the subject
        if (isset($subjectNames[$subjectId])) {
            $studentMarks[$studentId]['marks'][$subjectNames[$subjectId]] = $marksRow['marks'];
        }
    }

    $resultTypeData['details'] = array_values($studentMarks);
    $data[] = $resultTypeData;
}

$jsonData = json_encode($data, JSON_PRETTY_PRINT);
echo $jsonData;

mysqli_close($conn);
?>