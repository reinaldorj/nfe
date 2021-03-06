<?php

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe inicial da biblioteca
 * 
 * @class NFe
 * @version <1.0.0>
 * @date 08/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFe {

    private static $confFile;

    const LIB_DIR = "lib/";
    const WSDL_DIR = "wsdl/";
    const CERT_DIR = "cert/";
    const XSD_DIR = "xsd/";
    const VENDOR_DIR = "vendor/";

    /**
     * Método que faz o autoload das classes utilizadas
     * 
     * @param $className
     * @throws FileNotFoundException
     * @author Eric Maicon
     */
    public static function autoload($className) {
        $filename = self::getBasePath() . self::LIB_DIR . '/' . str_replace('\\', '/', $className) . '.php';
        if(is_file($filename)) {
            require($filename);
        } else {
            throw new \exceptions\FileNotFoundException("O arquivo " . $className . " não foi encontrado.");
        }
    }

    /**
     * Método inicial, que carrega os ini file, faz o require nos vendors...
     * 
     * @param $confFile
     * @author Eric Maicon
     */
    public static function configure($confFile) {
        self::parseIniFile($confFile);
    }

    /**
     * Método que carrega as configurações do arquivo
     * 
     * @param $confFile
     * @author Eric Maicon
     */
    private static function parseIniFile($confFile) {
        self::$confFile = parse_ini_file($confFile, true);
    }

    /**
     * Pega alguma configuração
     * 
     * @param $confGroup
     * @param $confName
     * @author Eric Maicon
     */
    public static function get($confGroup, $confName) {
        if(!isset(self::$confFile)) {
            throw new \exceptions\ConfigurationFaultException("Você não chamou a classe de configuração passando o arquivo .INI (Ex.: NFe::configure($configFile);)");
        }

        return self::$confFile[$confGroup][$confName];
    }

    /**
     * Retorna caminho de pastas do sistema
     * 
     * @author Eric Maicon
     */
    public static function getBasePath() {
        return realpath(dirname(__FILE__) . '/../') . '/';
    }

    /**
     * Retorna o código do estado
     * http://dtr2001.saude.gov.br/sas/decas/anexo01.mansia.htm
     * 
     * @author Eric Maicon
     */
    public static function getUfCode($UF) {
        switch($UF) {
            case 'RO': 
                return 11;
                break;
            case 'AC': 
                return 12;
                break;
            case 'AM': 
                return 13;
                break;
            case 'RR': 
                return 14;
                break;
            case 'PA': 
                return 15;
                break;
            case 'AP': 
                return 16;
                break;
            case 'TO': 
                return 17;
                break;
            case 'MA': 
                return 21;
                break;
            case 'PI': 
                return 22;
                break;
            case 'CE': 
                return 23;
                break;
            case 'RN': 
                return 24;
                break;
            case 'PB': 
                return 25;
                break;
            case 'PE': 
                return 26;
                break;
            case 'AL': 
                return 27;
                break;
            case 'SE': 
                return 28;
                break;
            case 'BA': 
                return 29;
                break;
            case 'MG': 
                return 31;
                break;
            case 'ES': 
                return 32;
                break;
            case 'RJ': 
                return 33;
                break;
            case 'SP': 
                return 35;
                break;
            case 'PR': 
                return 41;
                break;
            case 'SC': 
                return 42;
                break;
            case 'RS': 
                return 43;
                break;
            case 'MS': 
                return 50;
                break;
            case 'MT': 
                return 51;
                break;
            case 'GO': 
                return 52;
                break;
            case 'DF': 
                return 53;
                break;
        }
    }

}

setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

/**
 * Fazendo o carregamento automático das classes. 
 * Ele lê NFe::autoload
 * 
 * @author Eric Maicon
 */
spl_autoload_register(array('NFe', 'autoload'));