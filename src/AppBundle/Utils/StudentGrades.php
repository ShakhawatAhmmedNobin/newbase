<?php
/**
 * Created by PhpStorm.
 * User: marvi
 * Date: 09.02.2016
 * Time: 22:28
 */

namespace AppBundle\Utils;


use AppBundle\Entity\AmaseCourses;
use AppBundle\Entity\AmaseGrades;
use AppBundle\Entity\AmaseMaster;
use AppBundle\Entity\AmaseStudents;
use AppBundle\Entity\Grades;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Registry;
use FPDI;

class StudentGrades
{
    /**
     * Array von Noten, nur UDS und benotet
     * @var AmaseGrades[]
     */
    public $grades;
    /**
     *
     * @var int
     */
    public $studentID;
    /**
     * @var AmaseStudents
     */
    public $student;
    /**
     * Masterarbeit nur für UDS
     * @var AmaseMaster
     */
    public $master;
    /**
     * Datum der letzten Prüfung (oder master)
     * @var DateTime
     */
    public $lastDate;
    /**
     * Die Jahreszahl des Startsemesters
     * @var int
     */
    public $startYear;
    /**
     * Freiwillige Zusatzkurse nicht in die Note
     * @var AmaseGrades[]
     */
    public $voluntaryGrades;
    /**
     * Kurse die in die CP einfließen
     * @var AmaseGrades[]
     */
    public $nonVoluntaryGrades;
    /**
     * Kurse die in die Note einfließen
     * @var AmaseGrades[]
     */
    public $gradedGrades;
    /**
     * @var AmaseGrades[][]
     */
    public $modulSortedGrades;
    /**
     * @var Registry
     */
    /**
     * @var AmaseGrades[]
     */
    public $modulSortedNonUDSGrades;
    /**
     * @var AmaseGrades[]
     */
    public $modulGradedUdSGrades;
    /**
     * @var AmaseGrades[]
     */
    public $modulNonGradedUdSGrades;
    /**
     * @var AmaseGrades[]
     */
    public $modulZusatzGrades;
    /**
     * @var AmaseGrades[]
     */
    public $modulZusatzNotedGrades;
    /**
     * @var AmaseGrades[]
     */
    public $modulSortedNonUDSGradesLang;
    /**
     * @var AmaseGrades[]
     */
    public $modulSortedNonUDSGradesNoLang;
    /**
     * @var AmaseGrades[]
     */
    public $langGrades;
    private $doctrine;
    /**
     * @var float
     */
    public $averageGrade;


    /**
     * StudentGrades constructor.
     * @param Registry $doctrine
     * @param string $resources
     * @param int $studentID
     */
    function __construct(Registry $doctrine, string $resources, int $studentID)
    {
        $this->doctrine = $doctrine;
        $this->studentID = $studentID;
        $this->resourcesPath = $resources;
        $this->student = $doctrine
            ->getRepository('AppBundle:AmaseStudents')
            ->find($this->studentID);

        if (!$this->student) {
            return;
        }

        /** @var AmaseGrades[] $tempgrades */
        $tempgrades = $doctrine
            ->getRepository('AppBundle:AmaseGrades')
            ->findBy(array('studentId' => $this->studentID),
                array("modul" => "ASC",
                    "exDate" => "ASC"));

        //Filter out duplicates
        /** @var AmaseGrades[] $grades */
        $grades = array();
        foreach ($tempgrades as $newgrade) {

            if ($newgrade->getStatus() === "open"
                || $newgrade->getStatus() === "failed"
            ) {
                continue;
            }
            $notfound = true;
            foreach ($grades as $key => $oldgrade) {
                if ($newgrade->getCoursename() === $oldgrade->getCoursename()) {
                    if ($this->convertGrade($newgrade->getLocalGrade(), $newgrade->getUniversity())
                        > $this->convertGrade($oldgrade->getLocalGrade(), $oldgrade->getUniversity())
                    ) {

                        $grades[$key] = $newgrade;
                    }
                    $notfound = false;
                }
            }
            if ($notfound) {
                $grades[] = $newgrade;
            }
        }

        $langgrades = array();
        $extragrades = array();
        $nolanggrades = array();
        foreach ($grades as $grade) {
            if ($grade->getModul() === "Language") {
                $langgrades[] = $grade;
            } else if ($grade->getModul() === "Zusaetzliche Leistung") {
                $extragrades[] = $grade;
            } else {
                $nolanggrades[] = $grade;
            }
        }

        $this->grades = $grades = array_merge($nolanggrades, $langgrades, $extragrades);

        $novolgrades = array();
        foreach ($nolanggrades as $grade) {
            if ($grade->getModul() !== 'Voluntary Courses') {
                $novolgrades[] = $grade;
            }
        }
        $this->averageGrade = $this->sumGrades(array_merge($novolgrades));
        $languds = array();
        foreach ($langgrades as $grade) {
            if ($grade->getUniversity() !== 'UdS') {
                continue;
            }
            $languds[] = $grade;
        }
        $this->langGrades = $languds;

        $voluntary = array();
        $nonvoluntary = array();
        foreach ($this->grades as $grade) {
            if ($grade->getModul() === 'Voluntary Courses') {
                $voluntary[] = $grade;
            } else {
                $nonvoluntary[] = $grade;
            }
        }

        $this->voluntaryGrades = $voluntary;
        $this->nonVoluntaryGrades = $nonvoluntary;

        $graded = array();
        foreach ($this->nonVoluntaryGrades as $grade) {
            if ($grade->getStatus() === 'grade') {
                $graded[] = $grade;
            }
        }

        $this->gradedGrades = $graded;

        $moduls = array();
        foreach ($this->nonVoluntaryGrades as $grade) {
            $modul = $grade->getModul();
            if ($this->isValidTrackOrModul($modul,
                array('Track', 'Module', 'Language'))
            ) {
                if (!array_key_exists($modul, $moduls)) {
                    $moduls[$modul] = array();
                }
                $moduls[$modul][] = $grade;
            }
        }

        $this->modulSortedGrades = $moduls;


        $moduls = array();
        $nonUdS = array();
        foreach ($this->nonVoluntaryGrades as $grade) {
            $modul = $grade->getModul();
            if ($grade->getUniversity() !== 'UdS') {
                $nonUdS[] = $grade;
                continue;
            }
            if ($this->isValidTrackOrModul($modul,
                array('Track', 'Module', 'Language', 'Zus'))
            ) {
                if (!array_key_exists($modul, $moduls)) {
                    $moduls[$modul] = array();
                }
                $moduls[$modul][] = $grade;
            }
        }
        $this->modulSortedNonUDSGrades = $nonUdS;
        $this->modulSortedUDSGrades = $moduls;

        $nonUdSlang = array();
        $nonUdSnolang = array();
        foreach ($this->modulSortedNonUDSGrades as $grade) {
            $modul = $grade->getModul();
            if ($this->isValidTrackOrModul($modul,
                array('Language'))
            ) {
                $nonUdSlang[] = $grade;
            } else {
                $nonUdSnolang[] = $grade;
            }
        }
        $this->modulSortedNonUDSGradesLang = $nonUdSlang;
        $this->modulSortedNonUDSGradesNoLang = $nonUdSnolang;


        $gradedUds = array();
        $nonGradedUdS = array();
        foreach ($this->modulSortedUDSGrades as $gradearray) {
            foreach ($gradearray as $grade) {
                /** @var AmaseGrades $grade */
                if ($grade->getStatus() === 'grade') {
                    $gradedUds[] = $grade;
                } else {
                    $nonGradedUdS[] = $grade;
                }
            }
        }

        $this->modulGradedUdSGrades = $gradedUds;
        $this->modulNonGradedUdSGrades = $nonGradedUdS;


        $tempgrades = $doctrine
            ->getRepository('AppBundle:AmaseGrades')
            ->findBy(array(
                'studentId' => $this->studentID
            , "modul" => "Zusaetzliche Leistung"));
        $tempnotedgrades = $doctrine
            ->getRepository('AppBundle:AmaseGrades')
            ->findBy(array(
                'studentId' => $this->studentID,
                "modul" => "Zusaetzliche Leistung",
                "status" => "grade"));
        $this->modulZusatzGrades = $tempgrades;
        $this->modulZusatzNotedGrades = $tempnotedgrades;

        $this->master = $doctrine
            ->getRepository('AppBundle:AmaseMaster')
            ->findOneBy(array(
                'studentId' => $this->studentID,
                //'university' => 'UDS',
                'status' => 'grade'
            ));

        $lastExamArray = $doctrine
            ->getRepository('AppBundle:AmaseGrades')
            ->findBy(array(
                'studentId' => $this->studentID,
                'status' => array('grade', 'passed'),
            ), array(
                'exDate' => 'DESC'
            ));
        $lastExam = reset($lastExamArray);

        if ($this->master && $this->master->getExDate() > $lastExam->getExDate()) {
            $this->lastDate = $this->master->getExDate();
        } else if ($lastExam) {
            $this->lastDate = $lastExam->getExDate();
        } else {
            $this->lastDate = "No Grades yet!";
        }

        $this->startYear = intval(substr($this->student->getStartSemester(), 0, 4));
        $this->studFullName = " " . utf8_decode($this->student->getVorname())
            . " " . utf8_decode($this->student->getNachname());


    }

    function getEnglishName(AmaseGrades $grade) : string
    {

        /** @var AmaseCourses[] $courses */
        $courses = $this->doctrine->getRepository('AppBundle:AmaseCourses')
            ->findBy(array(
                'localDescription' => $grade->getCoursename()
            ));

        /** @var AmaseCourses $lastCourse */
        $lastCourse = reset($courses);
        if (!$lastCourse) {
            return "";
        }
        return $lastCourse->getEnglishDescription();
    }

    /**
     * @param AmaseGrades[] $grades
     * @return float
     */
    function sumGrades($grades)
    {
        $gradeSum = 0.0;
        $creditSum = 0.0;
        foreach ($grades as $grade) {
            if ($grade->getStatus() !== 'grade') {
                continue;
            }
            $realgrade = $this->convertGrade($grade->getLocalGrade(), $grade->getUniversity());
            $gradeSum += floatval($realgrade) * floatval($grade->getCredits());
            $creditSum += floatval($grade->getCredits());
        }
        if ($gradeSum < 0.1) {
            return 0.0;
        }
        $avg = floatval($gradeSum / $creditSum);
        $avground = floor($avg*100);
        //var_dump($avg, $avground);
        return $avground/100;
    }

    /**
     * @param AmaseGrades[] $grades
     * @return float
     */
    function sumCredits($grades)
    {
        $creditSum = 0.0;
        foreach ($grades as $grade) {
            $creditSum += floatval($grade->getCredits());
        }
        return $creditSum;
    }

    function stringStartsWith(string $haystack, string $needle)
    {
        return (0 === strpos($haystack, $needle));
    }

    /**
     * @param string $modul
     * @param string[] $options
     * @return bool
     */
    function isValidTrackOrModul(string $modul, $options)
    {
        foreach ($options as $needle) {
            if ($this->stringStartsWith($modul, $needle)) {
                return true;
            }
        }
        return false;
    }

    function checkFromUDS($pdf)
    {
        if ($this->student->getUniversity1() !== 'UdS'
            && $this->student->getUniversity2() !== 'UdS'
        ) {
            $this->generatePDFError($pdf, 'The Transcript of Records is available
            only for students that are studying in the UdS.');
            return false;
        }
        return true;
    }

    function checkStudentData($pdf)
    {
        if (!$this->student) {
            $this->generatePDFError($pdf, 'Student Nr. ' . $this->studentID . ' nicht gefunden!');
            return false;
        }
        return true;
    }

    /**
     * @param FPDI $pdf
     * @param string $text
     */
    function generatePDFError($pdf, string $text)
    {
        $pdf->addPage('P');
        $pdf->Cell(40, 10, $text);
    }

    function initFpdi(): FPDI
    {

        //ugly fix to get fonts to work again as directory changed to usr share
        $fontprefixfix = $this->resourcesPath . 'font';
        define('FPDF_FONTPATH', $fontprefixfix);

        $pdf = new FPDI();
        $pdf->AddFont('Univers55', '', 'univers55.php');
        $pdf->AddFont('Univers55', 'B', 'univers55b.php');
        $pdf->AddFont('Univers57cn', '', 'univers57cn.php');
        $pdf->AddFont('Univers57cn', 'B', 'univers57cnb.php');

        return $pdf;
    }

    function getZeugnisSourceFile()
    {
        if ($this->startYear >= 2011) {
            return $this->resourcesPath . "pdf/zeugnis_blanco_new.pdf";
        } else {
            return $this->resourcesPath . "pdf/zeugnis_blanco.pdf";
        }
    }

    function generateZeugnisFront(FPDI $pdf)
    {
        $pdf->setSourceFile($this->getZeugnisSourceFile());
        $tplidx = $pdf->ImportPage(1);
        $pdf->addPage('P');
        $pdf->useTemplate($tplidx);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->SetFont('Univers55', '', 18);
        $genderLen = $pdf->GetStringWidth($this->student->getGender());
        $pdf->SetFont('Univers55', 'B', 18);
        $nameLen = $pdf->GetStringWidth($this->studFullName);
        $textmiddle = 103 - ($nameLen / 2.0) - ($genderLen / 2.0);  // WIDTH

        $pdf->SetXY($textmiddle, 130);
        $pdf->SetFont('Univers55', '', 18);
        $pdf->SetTextColor(0, 51, 136);
        $pdf->Write(10, $this->student->getGender());
        $pdf->SetFont('Univers55', 'B', 18);
        $pdf->Write(10, $this->studFullName);
        $pdf->SetTextColor(0);

        $pdf->SetXY(0, 140); // Geburtsdaten
        $pdf->SetFont('Univers57cn', '', 12);
        $pdf->MultiCell(206, 5, "geboren am "
            . $this->student->getBirthDate()->format('Y-m-d')
            . "\n" . "in " . utf8_decode($this->student->getBirthPlace())
            . ", " . utf8_decode($this->student->getCountryBirth()) . "\n", 0, 'C');

        $pdf->SetXY(0, 218); // Letztes Prüfungsdatum
        $pdf->SetFont('Univers57cn', '', 12);
        $pdf->MultiCell(206.5, 5, utf8_decode("Datum der letzten Prüfungsleistung: ")
            . $this->lastDate->format('Y-m-d') . utf8_decode("\n\nSaarbrücken, den ") . date("d.m.Y"), 0, 'C');
    }

    function generateZeugnisHeader(FPDI $pdf)
    {
        $gradeSize = 8;
        $tplidx = $pdf->ImportPage(2);
        $pdf->addPage();
        $pdf->useTemplate($tplidx);

        ###### NAME AND SIMPLE LINE
        $pdf->SetXY(0, 30); // name
        $pdf->SetFont('Univers55', '', 18);
        $pdf->Cell(210, 5, $this->studFullName, 0, 0, 'C');
        $ly = $pdf->GetY() + 10;
        $padding = 15;
        $pdf->Line(0 + $padding, $ly, 210 - $padding, $ly);
        ###### NAME AND SIMPLE LINE

        ######  HEAD TITLES
        $pdf->SetXY(0, 47);
        $pdf->SetFont('Univers57cn', '', $gradeSize);
        $pdf->SetXY(10, $pdf->GetY());
        $pdf->Cell(130, 5, utf8_decode("Prüfungsleistungen"), 1, 0, 'L');
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->Cell(20, 5, "ECTS-Punkte", 1, 0, 'C');
        $x = $x + 20;
        $pdf->SetXY($x, $y);
        $pdf->Cell(20, 5, "Note", 1, 0, 'C');
        $pdf->Cell(20, 5, "ECTS-Note", 1, 0, 'C');
        $pdf->Ln();
        ######  HEAD TITLES
    }

    /**
     * @param FPDI $pdf
     * @param string $modulName
     * @param AmaseGrades[] $modul
     */
    function generateZeugnisModulHeader(FPDI $pdf, string $modulName, $modul)
    {
        $gradeSize = 8;
        $courseSize = 10;
        $pdf->SetXY(10, $pdf->GetY());
        $pdf->SetFont('Univers57cn', 'b', $courseSize);
        $pdf->Cell(130, 7, $modulName, 1, 0, 'L');

        $averageGrade = $this->sumGrades($modul);
        $sumCredits = min($this->sumCredits($modul)
            , $this->getCreditsLimit($modulName));

        $pdf->SetFont('Univers57cn', 'b', $courseSize);
        $pdf->Cell(20, 7, number_format($sumCredits, 1), 1, 0, 'C');

        if ($averageGrade > 0) {
            $udsFormat = number_format($this->convertGrade($averageGrade, 'UDS'), 1);
            $pdf->Cell(20, 7, substr($udsFormat, 0, 3), 1, 0, 'C');
        } else {
            $pdf->Cell(20, 7, "--", 1, 0, 'C');
        }
        $pdf->Cell(20, 7, "", 1, 0, 'C');

        $pdf->Ln();
        $pdf->SetFont('Univers57cn', 'b', $gradeSize);
        if ($modulName == "Language") {
            $text = "ECTS-Punkte in diesem Modul / Track:
Im 1. und 2. Semester: min-7 & max-9; Im 3. Semester: min-3 & max-5";
            $pdf->MultiCell(190, 5, $text, 1, 'L');
        } elseif ($modulName == "Module I: Structure & Properties") {
            $pdf->Cell(190, 5, "ECTS-Punkte in diesem Modul / Track:  (min-12 & max-15)", 1, 0, 'L');
            $pdf->Ln();
        } elseif ($modulName == "Module II: Materials Characterization") {
            $pdf->Cell(190, 5, "ECTS-Punkte in diesem Modul / Track:  (min-5 & max-8)", 1, 0, 'L');
            $pdf->Ln();
        } elseif ($modulName == "Module III: Materials Engineering & Processing Technologies") {
            $pdf->Cell(190, 5, "ECTS-Punkte in diesem Modul / Track:  (min-5 & max-8)", 1, 0, 'L');
            $pdf->Ln();
        } elseif ($modulName === 'Voluntary Courses') {
            $pdf->Cell(190, 5,
                utf8_decode("Note und ECTS-Punkte freiwilliger Kurse fließen nicht in die Berechnung ein.")
                , 1, 0, 'L');
            $pdf->Ln();
        }
    }

    function getCreditsLimit(string $modulName, bool $isUDS) : int
    {
        if ($modulName == "Module I: Structure & Properties") {
            return 15;
        }
        if ($modulName == "Module II: Materials Characterization"
            || $modulName == "Module III: Materials Engineering & Processing Technologies"
        ) {
            return 8;
        }
        if ($modulName == "Language") {
            if (($this->student->getUniversity1() == "UdS")
                == $isUDS) {
                return 9;
            }
            return 5;
        }
        return 99999; //big number
    }

    /**
     * @param FPDI $pdf
     * @param AmaseGrades $grade
     */
    function generateZeugnisModulGrade(FPDI $pdf, AmaseGrades $grade)
    {
        $gradeSize = 8;
        $pdf->SetXY(10, $pdf->GetY());
        $pdf->SetFont('Univers57cn', '', $gradeSize);
        $pdf->Cell(130, 5, utf8_decode($grade->getCoursename()), 0, 0, 'L');
        $pdf->Cell(20, 5, $grade->getCredits(), 0, 0, 'C');

        // bestanden for passed. The actual grade for grade
        if ($grade->getStatus() == "passed") {
            $pdf->Cell(20, 5, "bestanden", 0, 0, 'C');
        } else {
            $pdf->Cell(20, 5, $grade->getLocalGrade(), 0, 0, 'C');
        }

        // ECTS-Grade
        if ($grade->getEctsGrade() == "not set") {
            $pdf->Cell(20, 5, "--", 0, 0, 'C');
        } else {
            $pdf->Cell(20, 5, $grade->getEctsGrade(), 0, 0, 'C');
        }
        $pdf->Ln();
    }

    /**
     * @param FPDI $pdf
     * @param string $modulName
     * @param AmaseGrades[] $modul
     */
    function generateZeugnisModul(FPDI $pdf, string $modulName, $modul)
    {
        $this->generateZeugnisModulHeader($pdf, $modulName, $modul);
        foreach ($modul as $grade) {
            $this->generateZeugnisModulGrade($pdf, $grade);
        }

    }

    function generateZeugnis()
    {
        $pdf = $this->initFpdi();
        if (!$this->checkStudentData($pdf)) {
            return $pdf;
        }

        $this->generateZeugnisFront($pdf);
        $this->generateZeugnisHeader($pdf);
        if ($this->startYear >= 2011) {
            foreach ($this->modulSortedUDSGrades as $modulName => $modul) {
                $this->generateZeugnisModul($pdf, $modulName, $modul);
            }
            $this->generateZeugnisModul($pdf, 'Voluntary Courses', $this->voluntaryGrades);
        }

        $pdf->AddPage();
        $pdf->SetFont('Univers55', 'B', 16);

        $pdf->Cell(40, 10, 'Hello World! ' . $this->student->getVorname());
        $pdf->Ln();
        foreach ($this->nonVoluntaryGrades as $grade) {
            $pdf->Ln();
            $pdf->Cell(40, 10, "N " . $grade->getCourseName());
        }
        $pdf->Ln();
        $pdf->Ln();
        foreach ($this->voluntaryGrades as $grade) {
            $pdf->Ln();
            $pdf->Cell(40, 10, "V " . $grade->getCourseName());
        }
        $pdf->Ln();
        $pdf->Ln();
        if ($this->master) {
            $pdf->Cell(40, 10, $this->master->getProjectname());
        }

        $pdf->Ln();
        $pdf->Ln();
        if ($this->master) {
            $pdf->Cell(40, 10, $this->lastDate->format('Y-m-d H:i:s'));
        }
        return $pdf;
    }

    function generateTranscript()
    {
        $pdf = new TranscriptPDF($this);
        if ($this->checkStudentData($pdf)
            && $this->checkFromUDS($pdf)
        ) {
            $pdf->generateTranscript();
        }
        return $pdf;
    }


    function compareGradeWithString($grade, $expected, $gradestring, $comma, $point){
        return $grade >= $expected
            || $gradestring === $comma
            || $gradestring === $point;
    }

    /**
     * Legacy mapping to round grades
     * @param string|float $grade
     * @param string $university
     * @return float
     */
    function convertGrade($gradestring, $university)
    {

        if ($gradestring == "passed") {
            return $gradestring;
        }

        $grade = floatval(str_replace(",", ".", $gradestring));

        if ($university == "LTU") {
            if ($grade >= 5.0) {
                return 1.0;
            } elseif ($grade >= 4.0) {
                return 1.7;
            } elseif ($grade >= 3.0) {
                return 2.3;
            } elseif ($grade >= 2.0) {
                return 3.0;
            } elseif ($grade >= 1.0) {
                return 3.7;
            }
        } elseif ($university == "UPC") {
            if ($this->compareGradeWithString($grade, 9.8, $gradestring, '9,8','9.8')) {
                return 1.0;
            } elseif ($this->compareGradeWithString($grade, 9.2, $gradestring, '9,2','9.2')) {
                return 1.3;
            } elseif ($this->compareGradeWithString($grade, 8.6, $gradestring, '8,6','8.6')) {
                return 1.7;
            } elseif ($this->compareGradeWithString($grade, 8.1, $gradestring, '8,1','8.1')) {
                return 2.0;
            } elseif ($this->compareGradeWithString($grade, 7.5, $gradestring, '7,5','7.5')) {
                return 2.3;
            } elseif ($this->compareGradeWithString($grade, 7.0, $gradestring, '7,0','7.0')) {
                return 2.7;
            } elseif ($this->compareGradeWithString($grade, 6.5, $gradestring, '6,5','6.5')) {
                return 3.0;
            } elseif ($this->compareGradeWithString($grade, 5.9, $gradestring, '5,9','5.9')) {
                return 3.3;
            } elseif ($this->compareGradeWithString($grade, 5.3, $gradestring, '5,3','5.3')) {
                return 3.7;
            } elseif ($this->compareGradeWithString($grade, 5.0, $gradestring, '5,0','5.0')) {
                return 4.0;
            } else {
                return 5.0;
            }
        } elseif ($university == "UL") {
            if ($grade >= 16.0) {
                return 1.0;
            } elseif ($grade >= 15.0) {
                return 1.3;
            } elseif ($grade >= 14.0) {
                return 2.0;
            } elseif ($grade >= 13.0) {
                return 2.3;
            } elseif ($grade >= 12.0) {
                return 3.0;
            } elseif ($grade >= 11.0) {
                return 3.3;
            } elseif ($grade >= 6.8) {
                return 4.0;
            } else {
                return 5.0;
            }
        } elseif ($university == "UDS" || $university == "UdS") {
            if ($grade >= 5.0) {
                return 5.0;
            } elseif ($grade >= 4.0) {
                return 4.0;
            } elseif ($grade >= 3.7) {
                return 3.7;
            } elseif ($grade >= 3.3) {
                return 3.3;
            } elseif ($grade >= 3.0) {
                return 3.0;
            } elseif ($grade >= 2.7) {
                return 2.7;
            } elseif ($grade >= 2.3) {
                return 2.3;
            } elseif ($grade >= 2.0) {
                return 2.0;
            } elseif ($grade >= 1.7) {
                return 1.7;
            } elseif ($grade >= 1.3) {
                return 1.3;
            } elseif ($grade >= 1.0) {
                return 1.0;
            }

        }

    }

}