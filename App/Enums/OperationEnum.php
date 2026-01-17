<?php

namespace SoapTotvs\Enums;

enum OperationEnum: string
{
    case REALIZE_SQL_QUERY = 'RealizarConsultaSQL';
    case EXECUTE_WITH_XML_PARAMS = 'ExecuteWithXmlParams';
    case SAVE_RECORD = 'SaveRecord';
    case READ_RECORD = 'ReadRecord';
    case DELETE_RECORD = 'DeleteRecord';
    case DELETE_RECORD_BY_KEY = 'DeleteRecordByKey';
    case READ_VIEW = 'ReadView';
}
