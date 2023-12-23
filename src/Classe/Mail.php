<?php
namespace App\Classe;
use Mailjet\Client;
use Mailjet\Resources;
class Mail
{
    private $api_key="e23578de83f48588d5f0a11a869b8c82";
    private $api_key_secret="3d77ba4dd6c8167f418c16da72f8ce0d";
    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [ 'Email' => "kacem.benbrahim07@gmail.com", 'Name' => "MAILKACEM" ],
                    'To' => [ [ 'Email' => $to_email, 'Name' => $to_name ] ],
                    'TemplateID' => 5329170, 'TemplateLanguage' => true, 'Subject' => $subject, 'Variables' => [ 'content' => $content
                    ]
                    ]
                    ]
                ];
                $response = $mj->post(Resources::$Email, ['body' => $body]);
                $response->success();
            }

}