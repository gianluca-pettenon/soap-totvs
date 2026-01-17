<?php

namespace SoapTotvs\Enums;

enum WsdlEnum: string
{
    case QUERY = '/wsConsultaSQL/MEX?wsdl';
    case DATASERVER = '/wsDataServer/MEX?wsdl';
    case PROCESS = '/wsProcess/MEX?wsdl';
}
