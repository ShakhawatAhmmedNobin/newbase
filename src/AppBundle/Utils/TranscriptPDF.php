<?php
/**
 * Created by PhpStorm.
 * User: marvi
 * Date: 11.02.2016
 * Time: 20:04
 */

namespace AppBundle\Utils;

use AppBundle\Entity\AmaseGrades;

class TranscriptPDF extends \FPDF
{

    /**
     * @var StudentGrades
     */
    private $studentGrades;

    function __construct(StudentGrades $studentGrades)
    {
        parent::__construct();
        $this->studentGrades = $studentGrades;
    }

    function Header()
    {
        $this->Image($this->studentGrades->resourcesPath . 'icons/uds_head.jpg', 45, 5, 40);    //Logo 1
        $this->Image($this->studentGrades->resourcesPath . 'icons/amase_head.png', 115, 4, 50); //Logo 2

        // first title
        $this->SetXY(10, 22);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 7, 'ECTS - EUROPEAN CREDIT TRANSFER SYSTEM', 0, 1, 'C');
        $this->Cell(0, 10, 'Transcript of Records', 0, 1, 'C');
        $this->Ln(5);

        $this->SetFont('Arial', 'B', 11);
        $anredeName = $this->studentGrades->student->getAnrede('en') . "/"
            . $this->studentGrades->student->getAnrede('de') . $this->studentGrades->studFullName;
        $this->Cell(0, 3, $anredeName, 0, 1);
        $this->SetFont('Arial', '', 11);
        $geburtsDatum = "born on " . $this->studentGrades->student->getBirthDate()->format('d.m.Y')
            . " in " . utf8_decode($this->studentGrades->student->getBirthPlace())
            . ", " . utf8_decode($this->studentGrades->student->getCountryBirth());
        $this->Cell(0, 5, $geburtsDatum, 0, 1);

        $this->Ln(4); //Line break

        $matrikel1 = "1st Student-ID: " . $this->studentGrades->student->getMatrikel1()
            . " (" . $this->studentGrades->student->getUniversity1() . ")";
        $this->Cell(0, 5, $matrikel1, 0, 1);
        $matrikel2 = "2nd Student-ID: " . $this->studentGrades->student->getMatrikel2()
            . " (" . $this->studentGrades->student->getUniversity2() . ")";
        $this->Cell(0, 5, $matrikel2, 0, 1);

        $this->Ln(5); //Line break
    }

    function Footer()
    {   //Page footer
        $person = "Examination Board";
        $inst = "Saarland University";
        $fussnote = "German Grades: 1.0, 1.3, 1.7, 2.0, 2.3, 2.7, 3.0, 3.3, 3.7, 4.0, 5.0. Less is better, 5.0 means 'failed'";

        $this->SetY(-25);   //Position at 1.5 cm from bottom

        $this->SetFont('Arial', '', 10);
        $datum = utf8_decode('Saarbrücken, ') . date("F j, Y");
        $this->Cell(150, 7, $datum, 0, 0);
        $this->Cell(150, 7, $person, 0, 0);
        $this->Ln();
        $this->Cell(150, 7, "", 0, 0);
        $this->Cell(150, 7, $inst, 0, 0);

        $this->Ln(8);
        $this->SetFont('Arial', 'I', 8);  //Arial italic 8

        $this->Cell(170, 9, $fussnote, 1, 0, 'L');   //Footnote

        $this->Cell(20, 9, 'Page ' . $this->PageNo() . '/{nb}', 1, 0, 'R'); //Page number
    }

    function PrintLine()
    {
        $this->Line($this->GetX(), $this->GetY(), $this->GetX() + 190, $this->GetY());
    }

    /**
     * @param string $modulName
     * @param AmaseGrades[] $modul
     */
    function generateTranscriptModul(string $modulName, $modul)
    {
        $this->checkNewPage(230 - sizeof($modul) * 5);
        $this->generateTranscriptModulHeader($modulName, $modul);
        $fill = 1;
        foreach ($modul as $grade) {
            if ($this->checkNewPage()) {
                $this->generateTranscriptModulHeader($modulName, $modul);
            }
            $this->generateTranscriptModulGrade($grade, $fill);
            $fill = !$fill;
        }
        $this->generateTranscriptModulFooter($modulName, $modul, true);
    }

    /**
     * @param string $modulName
     * @param AmaseGrades[] $modul
     */
    function generateTranscriptModulHeader(string $modulName, $modul)
    {
        $this->SetFont('Arial', 'B', 11); // Names of the modules/tracks
        $this->Cell(200, 7, $modulName, 1, 0, 'L');
        $this->Ln();

    }

    function generateUDSHeader()
    {
        $this->SetLeftMargin(5);
        $this->AliasNbPages();
        $this->AddPage();
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(224, 235, 255);    // PDF-Farben festlagen
        $this->SetTextColor(0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(126, 7, 'Course', 1, 0, 'C');
        $this->Cell(20, 7, "Exam Date", 1, 0, 'C');
        $this->Cell(18, 7, 'ECTS grade', 1, 0, 'C');
        $this->Cell(18, 7, "ECTS credits", 1, 0, 'C');
        $this->Cell(18, 7, "Local grade", 1, 0, 'C');

        $this->Ln();
    }

    function generatePartnerHeader()
    {

        $partnerUni = $this->studentGrades->student->getPartnerUniversity();
        $this->checkNewPage(210);
        $this->SetFont('Arial', 'B', 11); // Names of the modules/tracks
        $this->Cell(200, 7, "Partner Universities - " . $partnerUni, 1, 0, 'L');
        $this->Ln();
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(100, 7, 'Course', 1, 0, 'C');
        $this->Cell(20, 7, "Exam Date", 1, 0, 'C');
        $this->Cell(26, 7, 'Module/Track', 1, 0, 'C');
        $this->Cell(18, 7, 'ECTS grade', 1, 0, 'C');
        $this->Cell(18, 7, "ECTS credits", 1, 0, 'C');
        $this->Cell(18, 7, "Grade", 1, 0, 'C');

        $this->Ln();
    }

    function generatePartnerLangHeader()
    {

        $partnerUni = $this->studentGrades->student->getPartnerUniversity();
        $this->checkNewPage(210);
        $this->SetFont('Arial', 'B', 11); // Names of the modules/tracks
        $this->Cell(200, 7, "Partner Universities - " . $partnerUni . " - Language", 1, 0, 'L');
        $this->Ln();
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(100, 7, 'Course', 1, 0, 'C');
        $this->Cell(20, 7, "Exam Date", 1, 0, 'C');
        $this->Cell(26, 7, 'Module/Track', 1, 0, 'C');
        $this->Cell(18, 7, 'ECTS grade', 1, 0, 'C');
        $this->Cell(18, 7, "ECTS credits", 1, 0, 'C');
        $this->Cell(18, 7, "Grade", 1, 0, 'C');

        $this->Ln();
    }

    function generateMaster()
    {
        $master = $this->studentGrades->master;
        $this->Ln();
        if ($this->GetY() > 210) $this->AddPage();
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(92, 5, "Master Thesis - " . $master->getUniversity(), 1, 0, 'L');
        $this->Cell(58, 5, "Examiner", 1, 0, 'L');
        $this->Cell(25, 5, "ECTS credits", 1, 0, 'C');
        $this->Cell(25, 5, "Local grade", 1, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 9);

        $x = $this->GetX();
        $y = $this->GetY();
        if (strlen($master->getProjectname()) < 60) {
            $this->MultiCell(92, 15, str_replace("\n", " ", utf8_decode($master->getProjectname())), 1, 'L', 0);
        } else if (strlen($master->getProjectname()) < 120) {
            $this->MultiCell(92, 5, str_replace("\n", " ", utf8_decode($master->getProjectname())) . "\n\n", 1, 'L', 0);
        } else {
            $this->MultiCell(92, 5, str_replace("\n", " ", utf8_decode($master->getProjectname())), 1, 'L', 0);
        }
        $x2 = $x + 92;
        $this->SetXY($x2, $y);

        $x = $this->GetX();
        $y = $this->GetY();
        $this->MultiCell(58, 5, utf8_decode($master->getExaminer1()) . "\n" . utf8_decode($master->getExaminer2()) . "\n\n", 1, 'L', 0);
        $x2 = $x + 58;
        $this->SetXY($x2, $y);

        $x = $this->GetX();
        $y = $this->GetY();
        $this->MultiCell(25, 5, "30.0\n\n ", 1, 'R', 0);
        $x2 = $x + 25;
        $this->SetXY($x2, $y);
        $this->MultiCell(25, 5, $master->getExaminerGrade1() . "\n" . $master->getExaminerGrade2() . "\n\n", 1, 'R', 0);
        $this->SetFont('Arial', 'B', 9);


        $this->Cell(150, 5, "Avg. grade: ", 1, 0, 'L');
        $this->Cell(25, 5, "--", 1, 0, 'C');
        $i = 0;
        if ($master->getExaminerGrade1()) $i++;
        if ($master->getExaminerGrade2()) $i++;
        if ($i == 0){
            $average_master = "passed";
        }else {
            $average_master = ((floatval($master->getExaminerGrade1()) + floatval($master->getExaminerGrade2())) / $i);
            $average_master = number_format($this->studentGrades->convertGrade($average_master, $master->getUniversity()), 1);
            $average_master = substr($average_master, 0, 3);
        }
        $this->Cell(25, 5, $average_master, 1, 0, 'R');
        $this->SetXY($x2, $y + 10); // 2 Zeilen Platz lassen um die Punktzahl einzutragen
        // $this->Cell(25,5, "Total: " .  $row['credits'],1,0,'R');
        $this->Ln();
        $this->Ln();
        $this->Ln();
    }

    function generateTranscript()
    {
        $this->generateUDSHeader();

        if ($this->studentGrades->startYear >= 2011) {
            foreach ($this->studentGrades->modulSortedUDSGrades as $modulName => $modul) {
                $this->generateTranscriptModul($modulName, $modul);
                $this->checkNewPage();
            }
            if (count($this->studentGrades->voluntaryGrades)) {
                $this->generateTranscriptModul('Voluntary Courses', $this->studentGrades->voluntaryGrades);
            }
            if (count($this->studentGrades->modulSortedNonUDSGradesNoLang) > 0) {
                $this->generatePartnerHeader();
                $fill = 1;
                foreach ($this->studentGrades->modulSortedNonUDSGradesNoLang as $grade) {
                    if ($this->checkNewPage()) {
                        $this->generatePartnerHeader();
                    }
                    $this->generateTranscriptModulGrade($grade, $fill, true);
                    $fill = !$fill;
                }
            }
            $this->Ln();
            if (count($this->studentGrades->modulSortedNonUDSGradesLang) > 0) {
                $this->generatePartnerLangHeader();
                $fill = 1;
                foreach ($this->studentGrades->modulSortedNonUDSGradesLang as $grade) {
                    if ($this->checkNewPage()) {
                        $this->generatePartnerLangHeader();
                    }
                    $this->generateTranscriptModulGrade($grade, $fill, true);
                    $fill = !$fill;
                }
                $this->generateTranscriptModulFooter("Language", $this->studentGrades->modulSortedNonUDSGradesLang, false);
            }
            $this->checkNewPage();
            if ($this->studentGrades->master) {
                $this->generateMaster();
            }
            $this->checkNewPage();
            $this->generatePointSums();
        }
    }

    /**
     * If we are to far in a page, add a new one.
     * @param int $max when to start a new line
     * @return bool
     */
    function checkNewPage($max = 230)
    {
        if ($this->GetY() > $max) {
            $this->AddPage();
            return true;
        }
        return false;
    }

    /**
     * @param string $modulName
     * @param AmaseGrades[] $modul
     * @param bool $isUDS
     */
    function generateTranscriptModulFooter(string $modulName, $modul, $isUDS = true)
    {
        $this->SetFont('Arial', 'B', 9);
        $height = 5;
        if ($modulName == "Language") {
            $text = "ECTS points with marks from this module / track:
In 1st and 2nd semester: min-7 & max-9; In 3rd semester: min-3 & max-5";
            $yBeforeCell = $this->GetY();
            $this->MultiCell(146, 5, $text, 1, 'L');
            $this->SetXY(151, $yBeforeCell);
            $height = 10;
        } elseif ($modulName == "Module I: Structure & Properties") {
            $this->Cell(146, 5, "ECTS points with marks from this module / track:  (min-12 & max-15)", 1, 0, 'L');
        } elseif ($modulName == "Module II: Materials Characterization") {
            $this->Cell(146, 5, "ECTS points with marks from this module / track:  (min-5 & max-8)", 1, 0, 'L');
        } elseif ($modulName == "Module III: Materials Engineering & Processing Technologies") {
            $this->Cell(146, 5, "ECTS points with marks from this module / track:  (min-5 & max-8)", 1, 0, 'L');
        } elseif ($modulName === 'Voluntary Courses') {
            $this->Cell(146, 5,
                utf8_decode("Note: The points & the marks of the additional courses are not considered in the average grade")
                , 1, 0, 'L');
        } elseif ($modulName === 'Zusaetzliche Leistung') {
            $this->Cell(146, 5,
                utf8_decode("Note: The marks of the additional courses are not considered in the average grade")
                , 1, 0, 'L');
        } else {
            $this->Cell(146, 5, "ECTS points with marks from this module / track:", 1, 0, 'L');
        }
        $this->Cell(18, $height, "", 1, 0, 'L');
        $sumCredits = min($this->studentGrades->sumCredits($modul)
            , $this->studentGrades->getCreditsLimit($modulName, $isUDS));


        $this->Cell(18, $height, number_format($sumCredits, 1), 1, 0, 'R');
        $this->Cell(18, $height, "", 1, 0, 'L');

        $this->Ln();
        $this->Ln();

    }

    /**
     * @param AmaseGrades $grade
     * @param int $fill
     * @param bool $expand
     */
    function generateTranscriptModulGrade(AmaseGrades $grade, int $fill, $expand = false)
    {


        $englishName = $this->studentGrades->getEnglishName($grade);
        $coursename = $grade->getCoursename();
        if ($englishName !== "") {
            $coursename .= " - " . $this->studentGrades->getEnglishName($grade);
        }

        $leftside = 126;
        $trackname = substr($grade->getModul(), 0, 10);
        if ($expand) {
            $leftside = 100;


            if ($trackname == 'Module III') {
                $trackname = 'Module III';
            } elseif ($trackname == 'Module II:') {
                $trackname = 'Module II';
            } elseif ($trackname == 'Module I: ') {
                $trackname = 'Module I';
            } elseif (substr($grade->getModul(), 0, 6) == 'Module'
                || $grade->getModul() === "Language"
            ) { // for Module 1, Module 2...
                $trackname = substr($grade->getModul(), 0, 8);
            } else // for tracks i.e. Track 1 , Track 2 and so on
            {
                $trackname = substr($grade->getModul(), 0, 7);
            }
        }
        $this->SetFont('Arial', '', 9);
        if (strlen($coursename) > 60) {
            $yBeforeCell = $this->GetY();
            $this->MultiCell($leftside, 5, utf8_decode($coursename), 1, 'L', $fill);
            $yCurrent = $this->GetY();
            $rowHeight = $yCurrent - $yBeforeCell;
            $this->SetXY($leftside + 5, $yBeforeCell);

        } else {
            $this->Cell($leftside, 5, wordwrap(utf8_decode($coursename), 60), 1, 0, 'L', $fill);
            $rowHeight = 5;
        }

        $this->Cell(20, $rowHeight, $grade->getExDate()->format('d.m.Y'), 1, 0, 'R', $fill);

        if ($expand) {
            $this->Cell(26, $rowHeight, $trackname, 1, 0, 'R', $fill);
        }
        $this->Cell(18, $rowHeight, $grade->getEctsGrade(), 1, 0, 'R', $fill);
        $this->Cell(18, $rowHeight, $grade->getCredits(), 1, 0, 'R', $fill);
        if ($grade->getStatus() != "passed") {
            $this->Cell(18, $rowHeight,
                number_format($this->studentGrades->convertGrade($grade->getLocalGrade(), $grade->getUniversity()), 1)
                , 1, 0, 'R', $fill);
        } else {
            $this->Cell(18, $rowHeight, "passed", 1, 0, 'R', $fill);
        }


        $this->Ln();

    }

    function generatePointSums()
    {

        $notedMax = "20.0";
        $allMax = "30.0";
        if ($this->studentGrades->student->getUniversity1() === "UdS") {
            $notedMax = "40.0";
            $allMax = "60.0";
        }
        $extraCourses = $this->studentGrades->sumCredits($this->studentGrades->modulZusatzGrades)
            - $this->studentGrades->sumCredits($this->studentGrades->modulZusatzNotedGrades);
        $pointSumGradedUDS = $this->studentGrades->sumCredits($this->studentGrades->modulGradedUdSGrades)
            - $this->studentGrades->sumCredits($this->studentGrades->modulZusatzNotedGrades);
        $sumLanguage = $this->studentGrades->sumCredits($this->studentGrades->langGrades);
        $maxLanguage = min($sumLanguage, $this->studentGrades->getCreditsLimit("Language", true));
        $languageOffset = $maxLanguage - $sumLanguage;

        $sumLanguageNonUDS = $this->studentGrades->sumCredits($this->studentGrades->modulSortedNonUDSGradesLang);
        $maxLanguageNonUDS = min($sumLanguageNonUDS, $this->studentGrades->getCreditsLimit("Language", false));
        $languageOffsetNonUDS = $maxLanguageNonUDS - $sumLanguageNonUDS;

        $pointSumNonGradedUDS = $this->studentGrades->sumCredits($this->studentGrades->modulNonGradedUdSGrades)
            + $languageOffset
            - $extraCourses;
        $pointSumzusatzGrades = $this->studentGrades->sumCredits($this->studentGrades->modulZusatzGrades);
        $pointSumUDS = $this->studentGrades->sumCredits($this->studentGrades->modulGradedUdSGrades)
            + $this->studentGrades->sumCredits($this->studentGrades->modulNonGradedUdSGrades) + $languageOffset;
        $overall = 0;
        if ($this->studentGrades->master) {
            $overall = 30;
        }
        $overall += $this->studentGrades->sumCredits($this->studentGrades->nonVoluntaryGrades);
        $pointSumOverall = $overall + $languageOffset + $languageOffsetNonUDS;

 /*       var_dump(
            compact(explode(' ', 'extraCourses pointSumGradedUDS sumLanguage maxLanguage languageOffset sumLanguageNonUDS maxLanguageNonUDS languageOffsetNonUDS pointSumNonGradedUDS pointSumzusatzGrades pointSumUDS overall pointSumOverall'
                )
            )
        );*/

        $this->Ln();
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(150, 5, "Total ECTS credit points from noted courses UdS", 1, 0, 'L'); // Zellraum auff�llen
        $this->Cell(25, 5, number_format($pointSumGradedUDS, 1) . "/" . $notedMax, 1, 0, 'R');
        $this->Cell(25, 5, "---", 1, 0, 'C');
        $this->Ln();
        $this->Cell(150, 5, "Total ECTS credit points from unnoted courses UdS", 1, 0, 'L'); // Zellraum auff�llen
        $this->Cell(25, 5, number_format($pointSumNonGradedUDS, 1), 1, 0, 'R');
        $this->Cell(25, 5, "---", 1, 0, 'C');
        $this->Ln();
        $this->Cell(150, 5, "Total ECTS credit points from Zusaetzliche Leistung UdS", 1, 0, 'L'); // Zellraum auff�llen
        $this->Cell(25, 5, number_format($pointSumzusatzGrades, 1), 1, 0, 'R');
        $this->Cell(25, 5, "---", 1, 0, 'C');
        $this->Ln();
        $this->Cell(150, 5, "Total ECTS credit points from all courses UdS", 1, 0, 'L'); // Zellraum auff�llen
        $this->Cell(25, 5, number_format($pointSumUDS, 1) . "/" . $allMax, 1, 0, 'R');
        $this->Cell(25, 5, "---", 1, 0, 'C');
        $this->Ln();
        $this->Cell(150, 5, "Total ECTS credit points from all courses and master project "
            . $this->studentGrades->student->getUniversity1() . " & " .
            $this->studentGrades->student->getUniversity2(), 1, 0, 'L'); // Zellraum auff�llen

        $this->Cell(25, 5, number_format($pointSumOverall, 1) . "/120.0", 1, 0, 'R');
        $this->Cell(25, 5, "---", 1, 0, 'C');
        $this->Ln();

        $this->SetFont('Arial', 'B', 9);    /// Durchschnittsnote
        $this->Cell(150, 5, "Avg. grade", 1, 0, 'L');
        $this->Cell(25, 5, "---", 1, 0, 'C');
        $this->SetFont('Arial', 'B', 9);
        $grade = $this->studentGrades->averageGrade;
        if ($grade <= 0.1) {
            $this->Cell(25, 5, 'none', 1, 0, 'R');
        } else {
            $average = ($grade);
            $this->Cell(25, 5, substr($average, 0, 3), 1, 0, 'R');
        }

    }

}