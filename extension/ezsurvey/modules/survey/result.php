<?php
//
// Created on: <02-Apr-2004 00:00:00 Jan Kudlicka>
//
// Copyright (C) 1999-2008 eZ Systems as. All rights reserved.
//
// This source file is part of the eZ Publish (tm) Open Source Content
// Management System.
//
// This file may be distributed and/or modified under the terms of the
// "GNU General Public License" version 2 as published by the Free
// Software Foundation and appearing in the file LICENSE.GPL included in
// the packaging of this file.
//
// Licencees holding valid "eZ Publish professional licences" may use this
// file in accordance with the "eZ Publish professional licence" Agreement
// provided with the Software.
//
// This file is provided AS IS with NO WARRANTY OF ANY KIND, INCLUDING
// THE WARRANTY OF DESIGN, MERCHANTABILITY AND FITNESS FOR A PARTICULAR
// PURPOSE.
//
// The "eZ Publish professional licence" is available at
// http://ez.no/products/licences/professional/. For pricing of this licence
// please contact us via e-mail to licence@ez.no. Further contact
// information is available at http://ez.no/home/contact/.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
//
// Contact licence@ez.no if any conditions of this licencing isn't clear to
// you.
//

/*! \file result.php
*/

$Module = $Params['Module'];
// $surveyID = $Params['SurveyID'];
$contentObjectID = $Params['ContentObjectID'];
$contentClassAttributeID = $Params['ContentClassAttributeID'];
$languageCode = $Params['LanguageCode'];

$count = 0;
$survey = eZSurvey::fetchByObjectInfo( $contentObjectID, $contentClassAttributeID, $languageCode );
if ( !is_object( $survey ) )
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );

$surveyID = $survey->attribute( 'id' );


// $survey = eZSurvey::fetch( $surveyID );

if ( !$survey )
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );

$surveyList = $survey->fetchQuestionList();
$count = eZSurveyResult::fetchResult( $contentObjectID, $contentClassAttributeID, $languageCode );

require_once( 'kernel/common/template.php' );
$tpl = templateInit();

$tpl->setVariable( 'contentobject_id', $contentObjectID );
$tpl->setVariable( 'contentclassattribute_id', $contentClassAttributeID );
$tpl->setVariable( 'language_code', $languageCode );

$tpl->setVariable( 'survey_questions', $surveyList );
$tpl->setVariable( 'survey_metadata', array() );
$tpl->setVariable( 'count', $count );

$Result = array();

$Result['content'] = $tpl->fetch( 'design:survey/result.tpl' );
$Result['path'] = array( array( 'url' => '/survey/list',
                                'text' => ezi18n( 'survey', 'Survey' ) ),
                         array( 'url' => false,
                                'text' => ezi18n( 'survey', 'Result overview' ) ) );

?>
