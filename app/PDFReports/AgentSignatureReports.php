<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;

class AgentSignatureReports
{
    /**
     * Generate Agent Signature Image PDF
     *
     * @param string $FName
     * @param string $LName
     * @param string $agentId
     */
    public function generate($FName = 'Ray', $LName = 'Faison', $agentId = 'RFX')
    {
        $fullName = $FName . ' ' . $LName;
        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    margin: 30px;
                }
                .title {
                    text-align: center;
                    font-size: 24px;
                    font-weight: bold;
                    margin-bottom: 15px;
                }
                .instructions {
                    font-size: 14px;
                    margin-bottom: 20px;
                    line-height: 1.5;
                }
                .top-row {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 20px;
                }
                .left {
                    width: 45%;
                    font-weight: bold;
                }
                .right {
                    width: 45%;
                    text-align: left;
                }
                .signature-box {
                    border: 1px solid black;
                    width: 600px;
                    height: 150px;
                    margin-top: 10px;
                }
            </style>
        </head>
        <body>
            <div class="title">Agent Signature Image</div>
            <div class="instructions">
                We are capturing your signature as a scanned image to allow us to automatically insert your signature into system-generated correspondence such as showings letters and expiration letters.
                Please sign your name as you would on a letter in the box below.
                <strong>DO NOT GO OVER ANY LINES. KEEP YOUR SIGNATURE WITHIN THE WHITE SPACE OF THE BOX.</strong>
            </div>
            <div>Thank you</div>
            <div class="top-row">
                <div class="left">Agent ID: ' . htmlspecialchars($agentId) . '</div>
                <div class="right">
                    Agent Name: <strong>' . htmlspecialchars($fullName) . '</strong><br><br>
                    <strong>SIGN IN THE BOX BELOW:</strong>
                </div>
            </div>
            <div class="signature-box"></div>
        </body>
        </html>
        ';
        /* $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('AgentSignature.pdf', ['Attachment' => true]); */
        return $html;
    }
}
