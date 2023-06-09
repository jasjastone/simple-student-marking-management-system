<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class PDF extends FPDF
{
    // Page header
    public $maxReason = 200;
    public $image = '';
    public $title = "";
    public $lineHeight = 10;
    public $maxCharacterOnLine = 93;
    function SetDash($black = null, $white = null)
    {
        if ($black !== null)
            $s = sprintf('[%.3F %.3F] 0 d', $black * $this->k, $white * $this->k);
        else
            $s = '[] 0 d';
        $this->_out($s);
    }
    public function Header()
    {
        if ($this->PageNo() == 1) :
            // Logo
            if ($this->image !== "") {
                $this->Image($this->image, 100, 6, 25, 25, 'png');
            }
            // Line break
            $this->Ln(20);
            // Arial bold 15
            $this->SetFont('Times', 'B', 15);
            // Title
            if ($this->title !== "") {
                $this->SetX(40);
                $this->Cell(0,  10, $this->title, 0, 1, 'C');
            }
            $this->Ln(5);
        endif;
    }

    // Page footer
    public function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 12
        $this->SetFont('Times', 'I', 12);
        // Page number
        $this->Cell(0, 10, $this->PageNo(), 0, 0, 'C');
    }
    public function ChapterTitle($title)
    {
    }
    public function forceDownload()
    {
        $this->Output('D', 'docs.pdf');
    }
    /**
     * function used to draw dots for a specified word
     * @param string $word the word that you want to draw dots
     * @param int $additional Dots the number of additional dots after the word
     * @param int $breakPoint The breaking point of the dot
     */
    public function drawDots($word, $additionalDots = 5, $breakPoint = 0)
    {
        $defaultLineBreakPoint = $breakPoint == 0 ? strlen($word) * 2 : $breakPoint;
        $breakPoint = $breakPoint == 0 ? strlen($word) * 2 : $breakPoint;
        for ($i = 0; $i < strlen($word) + $additionalDots; $i++) {
            if ($i != 0 && $i - $additionalDots >= $breakPoint) {
                $breakPoint += $defaultLineBreakPoint;
                $this->Cell(2, 10, '.', ln: 1);
            } else {
                $this->Cell(2, 10, '.');
            }
        }
    }
    /**
     * The function is used to draw dots for mult cell
     * @param string $word the word that you want to draw dots
     * @param int $additionalDots number of the additional dots after the word
     */
    public function drawDotsMultCell($word, $additionalDots = 5)
    {
        $dots = '.';
        for ($i = 0; $i < strlen($word) + $additionalDots; $i++) {
            $dots . ".";
        }
        $this->Cell(0, 0, strlen($dots));
        $this->MultiCell(0, 10, $dots, align: "L");
    }
    /**
     * @param string $paraghraph
     * @param int $breakPoint
     */
    public function writeParagrah($paraghraph, $breakPoint = 0)
    {
        $defaultLineBreakPoint = $breakPoint == 0 ? strlen($paraghraph) * 2 : $breakPoint;
        $breakPoint = $breakPoint == 0 ? strlen($paraghraph) * 2 : $breakPoint;
        for ($index = 0; $index < strlen($paraghraph); $index++) {
            if ($index >= $breakPoint) {
                $breakPoint += $defaultLineBreakPoint;
                $this->Cell(3, $this->lineHeight, $paraghraph[$index], ln: 1, align: 'C');
            } else {
                $this->Cell(3, 10, $paraghraph[$index]);
            }
        }
    }
    /**
     * @param string $paraghraph
     * @param int $goDeep
     */
    public function writeParagrahLine($paraghraph, $goDeep = 0)
    {
        $goDeep = floor(strlen($paraghraph) / $this->maxCharacterOnLine);
        if ($goDeep <= 0) {
            return;
        }
        $paraghraphArray = str_split($paraghraph, $this->maxCharacterOnLine);
        $paraghraphNow = $paraghraphArray[0];
        $paraghraphWidth = $this->GetStringWidth($paraghraphNow);
        $paraghraphNext = "";
        for ($i = 1; $i < count($paraghraphArray); $i++) {
            $paraghraphNext . $paraghraphArray[$i];
        }
        $this->Cell($paraghraphWidth, 10, $paraghraphNow . $goDeep, border: 1, ln: 1);
        $goDeep--;
        $this->writeParagrahLine($paraghraphNext, goDeep: $goDeep);
    }
    /**
     * @param string $paraghraph
     */
    public function writeParagrahMultCell($paraghraph)
    {
        $this->MultiCell(0, 10, $paraghraph);
    }
    /**
     * @param string $lineHeight
     * @param string $text
     */
    public function blueText($lineWidth, $lineHeight, $text)
    {
        $this->SetTextColor(0, 0, 200);
        $this->Cell($lineWidth, $lineHeight, $text);
        $this->SetTextColor(0, 0, 0);
    }

    /**
     * Draw a string through a line a of text
     * @param string $text
     * @return void
     */
    public function cellStringThrough($text, $breakline = false)
    {
        $width = $this->GetStringWidth($text);
        // Where the text starts, also where to start the strikethrough line.
        $x = $this->GetX();
        $y = $this->GetY() + ($this->lineHeight / 2);
        // Write out your text
        $this->Write($this->lineHeight, $text);
        // Then strike through
        $this->Line($x, $y, $x + $width, $y);
        if ($breakline) {
            $this->Ln($this->lineHeight);
        }
    }
    /**
     * @param int $y y offset on y axis
     * @param int $x x offset on x axis
     * @param string $txt
     */
    public function writeTextAboveText($y = 0, $x = 0, $txt)
    {
        // $this->SetX($this->G etStringWidth("Signature .................................."));
        if ($y > 0) {
            $newy = $this->GetY() - $y;
        } else {
            $newy = $this->GetY() + $y;
        }
        if ($x > 0) {
            $newx = $this->GetX() + $x;
        } else {
            $newx = $this->GetX() - $x;
        }
        $newx = $this->GetX() + $x;
        $y = $this->GetY();
        $x = $this->GetX();
        $this->SetY($newy);
        $this->SetX($newx);
        $this->Cell(10, $this->lineHeight, $txt);
        $this->SetY($y);
        $this->SetX($x);
    }
}
