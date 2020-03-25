<?php
declare(strict_types=1);

namespace App\Shell;

use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\ORM\TableRegistry;

/**
 * Scans shell command.
 */
class ScansShell extends Shell
{
    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    
    public function getOptionParser(): ConsoleOptionParser
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */


    public function main()
    {
        /*$this->out($this->OptionParser->help());*/
        $domains = TableRegistry::getTableLocator()->get('Domains');
        $scans = TableRegistry::getTableLocator()->get('Scans');
        $domainsQuery = $domains->find();
        $scansQuery = $scans->find();

        
        //$domainUpdateQuery = $domains->find();
        //date("Y-m-d h:i:s")
        //domain tauluun last update attempt ja last successful update
        foreach ($domainsQuery as $domain) 
        {           
                $scanUrl = 'whois '.$domain->url;
                $output = [];
                exec($scanUrl, $output);

                $currentDomain = $domains->get($domain->id);
                $currentDomain->last_update_attempt = date("Y-m-d h:i:s");
                $currentDomain->last_successful_update = date("Y-m-d h:i:s");
                $domains->save($currentDomain);

                $scanResultToString = implode("\n", $output);
                preg_match_all('/^(.*?)\\.*: (.+)/m', $scanResultToString, $matches);
                $n = count($matches[1]);

                for($i = 0; $i < $n; $i++)
                {
                	if($matches[1][$i] == "domain" && $matches[2][$i] == $domain->url)
                	{
                		echo $domain->url;
                	}
                	/*
                	elseif($matches[1][$i] == "expires")
                	{

                	}
                	*/

                	//echo $matches[1][$i], "->", $matches[2][$i], "\n";
                }
				/*$domainQuery->last_update_attempt = date("Y-m-d h:i:s");
            	$domainsQuery->last_successful_update = date("Y-m-d h:i:s");
            	$domains->save($domainsQuery);
            	*/   
        }
        /*print_r($output);
        $domainCreatedGrep  = preg_grep('/created/', $output);
        $domainExpiresGrep  = preg_grep('/expires/', $output);
        $domainRegistrarGrep  = preg_grep('/registrar..........:/', $output);
        //$domainRawScan = preg_grep('/\bdomain\b.*\b>>> Last update of WHOIS database:\b/', $output);
        //$matches[1] key $matches[2] value

        $domainCreatedToString = implode("\n", $domainCreatedGrep);
        preg_match_all('/\d{1,2}\.\d{1,2}\.\d{4}/',$domainCreatedToString, $domainCreatedDate);
        print_r($domainCreatedDate);

        $domainExpiresToString = implode("\n", $domainExpiresGrep);
        preg_match_all('/\d{1,2}\.\d{1,2}\.\d{4}/',$domainExpiresToString, $domainExpiresDate);
        print_r($domainExpiresDate);

        $domainRegistrarToString = implode("\n", $domainRegistrarGrep);
        preg_match_all('/\:(.*)/', $domainRegistrarToString, $domainRegistrar);
        print_r($domainRegistrar[1]);
        */                
    }
}