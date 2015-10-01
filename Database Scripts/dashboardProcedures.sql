USE [mubusassessment]
GO
/****** Object:  StoredProcedure [dbo].[getTopicInfoByGroupId]    Script Date: 10/1/2015 10:53:56 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		CWM / DPS
-- Create date: 10-1-2015
-- Description:	Takes group_id as parameter
--				Returns the topics assigned to that group_id in ascending order by topic_name 
-- =============================================
ALTER PROCEDURE [dbo].[getTopicInfoByGroupId]
	@groupid VARCHAR(30)
AS
BEGIN
	SELECT dashboard_topics.topic_id, dashboard_topics.topic_name FROM dashboard_topics
	INNER JOIN dashboard_topics_by_group
		ON dashboard_topics.topic_id = dashboard_topics_by_group.topic_id JOIN dashboard_groups
		ON dashboard_topics_by_group.group_id = dashboard_groups.group_id
	WHERE dashboard_groups.group_id = @groupid
	ORDER BY dashboard_topics.topic_name ASC;
END

-- *****************************************************************

USE [mubusassessment]
GO
/****** Object:  StoredProcedure [dbo].[getTopicInfoByGroupId]    Script Date: 10/1/2015 11:36:27 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		CWM / DPS
-- Create date: 10-1-2015
-- Description:	Takes group_id as parameter
--				Returns the topics assigned to that group_id in ascending order by topic_name 
-- =============================================
ALTER PROCEDURE [dbo].[getTopicInfoByGroupId]
	@groupid VARCHAR(30)
AS
BEGIN
	SELECT dashboard_topics.topic_id, dashboard_topics.topic_name FROM dashboard_topics
	INNER JOIN dashboard_topics_by_group
		ON dashboard_topics.topic_id = dashboard_topics_by_group.topic_id JOIN dashboard_groups
		ON dashboard_topics_by_group.group_id = dashboard_groups.group_id
	WHERE dashboard_groups.group_id = @groupid
	ORDER BY dashboard_topics.topic_name ASC;
END

-- *********************************************************************

-- ================================================
-- Template generated from Template Explorer using:
-- Create Procedure (New Menu).SQL
--
-- Use the Specify Values for Template Parameters 
-- command (Ctrl-Shift-M) to fill in the parameter 
-- values below.
--
-- This block of comments will not be included in
-- the definition of the procedure.
-- ================================================
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		cwm / dps
-- Create date: 10-1-2015
-- Description:	Takes in section_id as parameter
--				Returns url_id, url_name, url_address ORDER BY url_name ASCENDING for that section
-- =============================================
CREATE PROCEDURE [dbo].[getURLinfoBySectionId]
	@section_id VARCHAR(30)
AS
BEGIN
	SELECT dashboard_urls.url_id, dashboard_urls.url_name, dashboard_urls.url_address FROM dashboard_urls
	INNER JOIN dashboard_url_by_section
		ON dashboard_urls.url_id = dashboard_url_by_section.url_id JOIN dashboard_sections
		ON dashboard_sections.section_id = dashboard_url_by_section.section_id
	WHERE dashboard_sections.section_id = @section_id
	ORDER BY dashboard_urls.url_name ASC;
END
GO